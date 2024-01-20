<?php

namespace App\Services;

use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class QuestionService
{
    public function store(array $data): Question
    {
        $question = new Question();

        return $this->persist($question, $data);
    }

    public function update(Question $question, array $data): Question
    {
        return $this->persist($question, $data);
    }

    public function delete(Question $question)
    {
        try {
            DB::beginTransaction();

            $question->delete();

            DB::commit();

            return $question;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    private function persist(Question $question, array $data): Question|Throwable
    {
        $data['slug'] = Str::slug($data['question']);

        try {
            DB::beginTransaction();

            $question->fill($data);

            $question->save();

            DB::commit();

            return $question;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
