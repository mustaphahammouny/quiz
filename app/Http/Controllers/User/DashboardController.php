<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Member;
use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::count();
        $members = Member::count();
        $attempts = Attempt::count();

        return view('user.dashboard', compact('quizzes', 'members', 'attempts'));
    }
}
