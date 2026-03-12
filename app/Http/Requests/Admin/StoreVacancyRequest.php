<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:vacancies,slug'],
            'employment_type' => ['nullable', 'string', 'max:100'],
            'summary' => ['required', 'string', 'max:500'],
            'headline' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'qualifications_raw' => ['required', 'string'],
            'skills_raw' => ['required', 'string'],
            'salary_range' => ['required', 'string', 'max:255'],
            'salary_note' => ['nullable', 'string', 'max:255'],
            'salary_context' => ['nullable', 'string', 'max:255'],
            'benefits_raw' => ['required', 'string'],
            'poster_path' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
