<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Member;
use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        // let's assume that the pass percentage
        $passCriteria = 70;

        $quizzesCount = Quiz::count();
        $membersCount = Member::count();
        $attempts = Attempt::all();
        $attemptsCount = $attempts->count();

        $averageScore = 0;
        $passRate = 0;
        $failRate = 0;

        if ($attemptsCount) {
            $averageScore = $attempts->sum('score') / $attemptsCount;
            $passRate = ($attempts->where('score', '>=', $passCriteria)->count() / $attemptsCount) * 100;
            $failRate = ($attempts->where('score', '<', $passCriteria)->count() / $attemptsCount) * 100;
        }

        return view('user.dashboard', [
            'stats' => [
                ['name' => 'Quizzes', 'count' => $quizzesCount, 'route' => 'quizzes.index',],
                ['name' => 'Members', 'count' => $membersCount, 'route' => 'members.index',],
                ['name' => 'Attempts', 'count' => $attemptsCount, 'route' => 'attempts.index',],
                ['name' => 'Average Score (%)', 'count' => $averageScore,],
                ['name' => 'Pass Rate (%)', 'count' => $passRate,],
                ['name' => 'Fail Rate (%)', 'count' => $failRate,],
            ]
        ]);
    }
}
