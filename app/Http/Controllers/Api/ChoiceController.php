<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChoiceResource;
use App\Models\Choice;
use App\Models\Question;

class ChoiceController extends Controller
{
    public function index(Question $question)
    {
        $choices = $question->choices()->paginate(10);

        return ChoiceResource::collection($choices);
    }

    public function show(Choice $choice)
    {
        return new ChoiceResource($choice);
    }
}
