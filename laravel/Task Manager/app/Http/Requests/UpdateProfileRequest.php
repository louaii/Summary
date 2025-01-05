<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'phone' => 'sometimes|required|string|max:15',
            'address' => 'sometimes|nullable|string|max:100',
            'date_birth' => 'sometimes|nullable|date',
            'bio' => 'sometimes|nullable|string'
        ];
    }
}
