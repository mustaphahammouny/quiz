<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuizRequest;
use App\Models\Quiz;
use App\Services\QuizService;
use Exception;

class QuizController extends Controller
{
    public function __construct(protected QuizService $quizService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::paginate(10);

        return view('user.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizRequest $request)
    {
        $data = $request->validated();

        try {
            $this->quizService->store($data);

            return redirect()->route('quizzes.index')
                ->with('success', 'Quiz created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        return view('user.quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizRequest $request, Quiz $quiz)
    {
        $data = $request->validated();

        try {
            $this->quizService->update($quiz, $data);

            return redirect()->route('quizzes.index')
                ->with('success', 'Quiz updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        try {
            $this->quizService->delete($quiz);

            return redirect()->back()->with('success', 'Quiz deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
