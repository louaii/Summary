<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    //solid principles https://medium.com/@eloufirhatim/solid-principles-in-laravel-1418be178346
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:40',
            'description'=>'nullable|string',
            'priority'=>'required|integer|min:1|max:5'
        ];
    }

    // public function messages(){} to create message in case of an error
}
