<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'sometimes|string|max:40',
            'description'=>'sometimes|nullable|string',
            'priority'=>'sometimes|required|integer|min:1|max:5'
        ];
    }

    // public function messages(){} to create message in case of an error
}
