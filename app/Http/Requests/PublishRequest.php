<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set to true if all authenticated users can publish tasks
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:tasks,id'], // Task ID must exist
            'status' => ['required', 'string', 'in:Complete,On_Going,Rejected_kay_bugo'],
            'published_on' => ['required', 'date'], // Must be a valid date
        ];
    }

    /**
     * Optional: Customize validation messages
     */
    public function messages(): array
    {
        return [
            'id.required' => 'Task ID is required.',
            'id.exists' => 'The task does not exist.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be one of: Complete, On_Going, Rejected_kay_bugo.',
            'published_on.required' => 'Published date is required.',
            'published_on.date' => 'Published date must be a valid date.',
        ];
    }
}
