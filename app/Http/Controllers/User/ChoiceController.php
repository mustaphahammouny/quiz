<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChoiceRequest;
use App\Models\Choice;
use App\Models\Question;
use Exception;
use Illuminate\Support\Facades\DB;

class ChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Question $question)
    {
        $choices = $question->choices()->paginate(10);

        return view('choices.index', compact('question', 'choices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Question $question)
    {
        return view('choices.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChoiceRequest $request, Question $question)
    {
        $data = $request->validated();
        $data['question_id'] = $question->id;
        $data['is_correct'] = $request->boolean('is_correct');

        $choice = new Choice();

        $this->persist($choice, $data);

        return redirect()->route('choices.index', ['question' => $question->id])
            ->with('success', 'Choice created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Choice $choice)
    {
        $choice->load('question');

        return view('choices.edit', compact('choice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChoiceRequest $request, Choice $choice)
    {
        $data = $request->validated();
        $data['is_correct'] = $request->boolean('is_correct');

        $this->persist($choice, $data);

        return redirect()->route('choices.index', ['question' => $choice->question_id])
            ->with('success', 'Choice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Choice $choice)
    {
        $choice->delete();

        return redirect()->back()->with('success', 'Choice deleted successfully!');
    }

    private function persist(Choice $choice, array $data)
    {
        try {
            DB::beginTransaction();

            $choice->fill($data);

            $choice->save();

            DB::commit();

            return $choice;
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
