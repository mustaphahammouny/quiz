<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attempt;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::with('member', 'quiz', 'answers')
            ->paginate(10);

        return view('user.attempts.index', compact('attempts'));
    }

    public function show(Attempt $attempt)
    {
        $attempt->load('quiz', 'answers');

        return view('user.attempts.show', compact('attempt'));
    }
}
