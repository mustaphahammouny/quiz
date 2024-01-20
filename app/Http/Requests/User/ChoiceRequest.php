<?php

namespace App\Http\Requests\User;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChoiceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'explanation' => ['nullable', 'string'],
            'is_correct' => ['boolean'],
        ];

        if ($this->isMethod('post')) {
            $rules['question_id'] = ['required', 'integer', Rule::exists(Question::class, 'id')->where('tenant_id', tenant('id'))];
        }

        return $rules;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_correct' => $this->boolean('is_correct'),
        ]);
    }
}
