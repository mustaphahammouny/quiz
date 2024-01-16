<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Subscribed;
use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount('questions')
            ->withExists(['members' => function ($query) {
                $query->where('members.id', Auth::guard('tenant')->id());
            }])
            ->whereNull('end_time')
            ->orWhere('end_time', '>', now())
            ->paginate(12);

        return view('tenant.quizzes.index', compact('quizzes'));
    }

    public function subscribe(Quiz $quiz)
    {
        $member = Auth::guard('tenant')->user();

        try {
            DB::beginTransaction();

            $token = Str::uuid();

            $member->quizzes()->attach($quiz, ['token' => $token]);

            Subscribed::dispatch($member, $quiz, $token);

            DB::commit();

            return redirect()->back()->with(['success' => 'Subscription updated successfully!']);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function unsubscribe(Quiz $quiz)
    {
        $member = Auth::guard('tenant')->user();

        $member->quizzes()->detach($quiz);

        return redirect()->back()->with(['success' => 'Subscription updated successfully!']);
    }

    public function take(string $token)
    {
        $member = Auth::guard('tenant')->user();

        $quiz = $member->quizzes()
            ->with(['questions.choices' => function ($query) {
                $query->orderBy('order', 'asc');
            }])
            ->wherePivot('token', $token)
            ->whereNull('end_time')
            ->orWhere('end_time', '>', now())
            ->firstOrFail();

        return view('tenant.quizzes.take', compact('quiz'));
    }
}
