<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\AttemptRequest;
use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttemptController extends Controller
{
    public function index()
    {
    }

    public function store(AttemptRequest $request, Quiz $quiz)
    {
        $data = $request->validated();

        $quiz->load('questions.choices');

        $questions = $quiz->questions->keyBy('id');

        $answers = [];

        foreach ($data['answers'] as $questionId => $answerIds) {
            $question = $questions->get($questionId);
            $choices = $question->choices->keyBy('id');
            $correctChoices = $question->choices->where('is_correct', true);

            $chosenAnswers = [];

            foreach ($answerIds as $answerId) {
                $chosenAnswers[] = $choices->get($answerId)->title;
            }

            $isCorrect = empty(array_diff($correctChoices->pluck('id')->toArray(), $answerIds));

            $answers[] = [
                'question' => $question->question,
                'is_correct' => $isCorrect,
                'chosen_answers' => $chosenAnswers,
                'correct_answers' => $correctChoices->pluck('title')->toArray(),
            ];
        }

        try {
            DB::beginTransaction();

            $attempt = $quiz->attempts()->create([
                'member_id' => Auth::guard('tenant')->id(),
            ]);

            $attempt->answers()->createMany($answers);

            DB::commit();

            return redirect()->route('tenant.quizzes.index')->with(['success' => 'Attempt created successfully!']);
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
