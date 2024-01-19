<?php

namespace App\Http\Requests\User;

use App\Models\Member;
use App\Models\Quiz;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'member_id' => [Rule::when($this->member_id != 0, Rule::exists(Member::class, 'id'))],
            'quiz_id' => [Rule::when($this->quiz_id != 0, Rule::exists(Quiz::class, 'id'))],
        ];
    }
}
