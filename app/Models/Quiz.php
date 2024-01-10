<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Quiz extends Model
{
    use HasFactory, BelongsToTenant;

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
