<?php

namespace App\Http\Controllers\Tenant;

use App\Events\Finished;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\AttemptRequest;
use App\Models\Attempt;
use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::with('quiz', 'answers')
            ->where('member_id', Auth::guard('tenant')->id())
            ->paginate(10);

        return view('tenant.attempts.index', compact('attempts'));
    }

    public function store(AttemptRequest $request, Quiz $quiz)
    {
        $data = $request->validated();

        $quiz->load('questions.choices');

        $questions = $quiz->questions->keyBy('id');

        $answers = [];
        $correctAnswersCount = 0;

        foreach ($data['answers'] as $questionId => $answerIds) {
            $question = $questions->get($questionId);
            $correctChoices = $question->choices->where('is_correct', true);
            $chosenAnswers = $question->choices->whereIn('id', $answerIds)->pluck('title')->toArray();            
            $correctChoicesIds = $correctChoices->pluck('id')->toArray();
            $isCorrect = empty(array_diff($correctChoicesIds, $answerIds)) && empty(array_diff($answerIds, $correctChoicesIds));

            $answers[] = [
                'question' => $question->question,
                'is_correct' => $isCorrect,
                'chosen_answers' => $chosenAnswers,
                'correct_answers' => $correctChoices->pluck('title')->toArray(),
            ];

            if ($isCorrect) {
                $correctAnswersCount++;
            }
        }

        try {
            DB::beginTransaction();

            $attempt = $quiz->attempts()->create([
                'member_id' => Auth::guard('tenant')->id(),
                'score' => ($correctAnswersCount / $quiz->questions->count()) * 100,
            ]);

            $attempt->answers()->createMany($answers);

            Finished::dispatch(Auth::guard('tenant')->user(), $attempt);

            DB::commit();

            return redirect()->route('tenant.quizzes.index')->with(['success' => 'Quiz finished successfully! we sent the score to your email!']);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show(Attempt $attempt)
    {
        $attempt->load('quiz', 'answers');

        return view('tenant.attempts.show', compact('attempt'));
    }
}
