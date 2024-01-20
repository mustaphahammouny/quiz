<?php

namespace App\Http\Requests\User;

use App\Models\Quiz;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'question' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];

        if ($this->isMethod('post')) {
            $rules['quiz_id'] = ['required', 'integer', Rule::exists(Quiz::class, 'id')->where('tenant_id', tenant('id'))];
        }

        return $rules;
    }
}
