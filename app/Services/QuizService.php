<?php

namespace App\Services;

use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class QuizService
{
    public function store(array $data): Quiz
    {
        $quiz = new Quiz();

        return $this->persist($quiz, $data);
    }

    public function update(Quiz $quiz, array $data): Quiz
    {
        return $this->persist($quiz, $data);
    }

    public function delete(Quiz $quiz)
    {
        try {
            DB::beginTransaction();

            $quiz->delete();

            DB::commit();

            return $quiz;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    private function persist(Quiz $quiz, array $data): Quiz|Throwable
    {
        $data['slug'] = Str::slug($data['title']);

        try {
            DB::beginTransaction();

            $quiz->fill($data);

            $quiz->save();

            DB::commit();

            return $quiz;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
