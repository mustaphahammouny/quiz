<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\QuizRequest;
use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuizController extends Controller
{
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

        $quiz = new Quiz();

        $this->persist($quiz, $data);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz created successfully!');
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

        $this->persist($quiz, $data);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->back()->with('success', 'Quiz deleted successfully!');
    }

    private function persist(Quiz $quiz, array $data)
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

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
