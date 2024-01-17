<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::withCount('attempts')
            ->paginate(10);

        return view('user.members.index', compact('members'));
    }
}
