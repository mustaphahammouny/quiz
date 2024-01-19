<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttemptResource;
use App\Models\Attempt;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = Attempt::with(['member', 'quiz'])
            ->paginate(10);

        return AttemptResource::collection($attempts);
    }

    public function show(Attempt $attempt)
    {
        $attempt->load(['member', 'quiz', 'answers']);

        return new AttemptResource($attempt);
    }
}
