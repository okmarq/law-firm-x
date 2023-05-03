<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:64',
            'email' => 'required|string|max:32|unique:clients,email',
            'date_profiled' => 'required|date_format:Y-m-d',
            'primary_legal_counsel' => 'required|string|max:64',
            'case_detail' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y-m-d',
            'profile_image' => 'nullable|image|max:2048',
        ];
    }
}
