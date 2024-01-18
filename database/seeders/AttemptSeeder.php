<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Quiz;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttemptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->runForEach(function ($tenant) {
            $members = Member::all();
            $quizzes = Quiz::with('questions.choices')->get();

            for ($i = 0; $i < 2000; $i++) {
                $member = $members->random();
                $quiz = $quizzes->random();

                $answers = [];
                $correctAnswersCount = 0;

                foreach ($quiz->questions as $question) {
                    $correctChoices = $question->choices->where('is_correct', true);
                    $chosenAnswers = $question->choices->random(rand(1, $question->choices->count() - 1));
                    $correctChoicesArray = $correctChoices->pluck('id')->toArray();
                    $chosenAnswersArray = $chosenAnswers->pluck('id')->toArray();
                    $isCorrect = empty(array_diff($correctChoicesArray, $chosenAnswersArray)) && empty(array_diff($chosenAnswersArray, $correctChoicesArray));

                    $answers[] = [
                        'question' => $question->question,
                        'is_correct' => $isCorrect,
                        'chosen_answers' => $chosenAnswers->pluck('title')->toArray(),
                        'correct_answers' => $correctChoices->pluck('title')->toArray(),
                    ];

                    if ($isCorrect) {
                        $correctAnswersCount++;
                    }
                }

                $attempt = $quiz->attempts()->create([
                    'member_id' => $member->id,
                    'score' => ($correctAnswersCount / $quiz->questions->count()) * 100,
                ]);

                $attempt->answers()->createMany($answers);
            }
        });
    }
}
