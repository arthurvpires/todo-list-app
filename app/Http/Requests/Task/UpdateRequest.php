<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => 'string|max:255',
            'status' => 'string|in:pending,in_progress,done',
        ];
    }

    public function messages(): array
    {
        return [
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'status.string' => 'The status must be a string.',
            'status.in' => 'The status must be one of the following values: pending, in_progress, done.',
        ];
    }
}
