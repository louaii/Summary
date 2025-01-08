<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            //  'user_id' => 'required|exists:users,id',
            'title'=>'required|string|max:40',
            'description'=>'nullable|string',
            'priority'=>'required|in:High, Medium, Low'
        ];
    }

    // public function messages(){} to create message in case of an error
}
