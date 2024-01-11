<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Models\Question;
use App\Models\Quiz;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->paginate(10);

        return view('questions.index', compact('quiz', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionStoreRequest $request, Quiz $quiz)
    {
        $data = $request->validated();
        $data['quiz_id'] = $quiz->id;

        $question = new Question();

        $this->persist($question, $data);

        return redirect()->route('questions.index', ['quiz' => $quiz->id])
            ->with('success', 'Quiz created successfully!');
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
    public function edit(Question $question)
    {
        $question->load('quiz');

        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionUpdateRequest $request, Question $question)
    {
        $data = $request->validated();

        $this->persist($question, $data);

        return redirect()->route('questions.index', ['quiz' => $question->quiz_id])
            ->with('success', 'Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->back()->with('success', 'Question deleted successfully!');
    }

    private function persist(Question $question, array $data)
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

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
