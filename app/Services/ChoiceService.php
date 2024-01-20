<?php

namespace App\Services;

use App\Models\Choice;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class ChoiceService
{
    public function store(array $data): Choice
    {
        $choice = new Choice();

        return $this->persist($choice, $data);
    }

    public function update(Choice $choice, array $data): Choice
    {
        return $this->persist($choice, $data);
    }

    public function delete(Choice $choice)
    {
        try {
            DB::beginTransaction();

            $choice->delete();

            DB::commit();

            return $choice;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    private function persist(Choice $choice, array $data): Choice|Throwable
    {
        try {
            DB::beginTransaction();

            $choice->fill($data);

            $choice->save();

            DB::commit();

            return $choice;
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
