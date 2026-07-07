<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:150',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'sometimes|in:student,faculty',
            'university_id' => 'nullable|exists:universities,id',
            'department' => 'nullable|max:100',
            'education_level' => 'nullable|in:HSC,Bachelor\'s,Master\'s,PhD',
            'cgpa' => 'nullable|numeric|between:0,4',
            'fields_of_interest' => 'nullable|string|max:500',
            'country_id' => 'nullable|exists:countries,id',
            'research_experience_years' => 'nullable|integer|min:0',
        ];
    }
}