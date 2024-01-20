<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChoiceRequest;
use App\Models\Choice;
use App\Models\Question;
use App\Services\ChoiceService;
use Exception;

class ChoiceController extends Controller
{
    public function __construct(protected ChoiceService $choiceService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Question $question)
    {
        $choices = $question->choices()->paginate(10);

        return view('user.choices.index', compact('question', 'choices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Question $question)
    {
        return view('user.choices.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChoiceRequest $request)
    {
        $data = $request->validated();

        try {
            $choice = $this->choiceService->store($data);

            return redirect()->route('choices.index', ['question' => $choice->question_id])
                ->with('success', 'Choice created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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

        return view('user.choices.edit', compact('choice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChoiceRequest $request, Choice $choice)
    {
        $data = $request->validated();

        try {
            $this->choiceService->update($choice, $data);

            return redirect()->route('choices.index', ['question' => $choice->question_id])
                ->with('success', 'Choice updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Choice $choice)
    {
        try {
            $this->choiceService->delete($choice);

            return redirect()->back()->with('success', 'Choice deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
