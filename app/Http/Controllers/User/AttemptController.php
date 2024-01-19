<?php

namespace App\Http\Controllers\User;

use App\Exports\AttemptExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\ExportRequest;
use App\Listeners\SendCompletedExportNotification;
use App\Models\Attempt;
use App\Models\Member;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::with('member', 'quiz', 'answers')
            ->paginate(10);

        $quizzes = Quiz::all();
        $members = Member::all();

        return view('user.attempts.index', compact('attempts', 'quizzes', 'members'));
    }

    public function show(Attempt $attempt)
    {
        $attempt->load('quiz', 'answers');

        return view('user.attempts.show', compact('attempt'));
    }

    public function export(ExportRequest $request)
    {
        $data = $request->validated();

        (new AttemptExport($data))->queue('attempts.csv')->chain([
            new SendCompletedExportNotification(Auth::user()),
        ]);

        return back()->withSuccess('Export file is sent to your email!');
    }
}
