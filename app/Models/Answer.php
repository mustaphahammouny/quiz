<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'attempt_id',
        'question',
        'is_correct',
        'chosen_answers',
        'correct_answers',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'chosen_answers' => 'array',
        'correct_answers' => 'array',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(Attempt::class);
    }
}
