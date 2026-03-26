<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInternshipStepTwoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'divisi_pilihan' => [
            'required',
            Rule::in(collect(config('site.internships.divisions', []))->pluck('title')->filter()->all()),
        ],
        'mulai_magang' => ['required', 'date'],
        'selesai_magang' => ['required', 'date', 'after_or_equal:mulai_magang'],
        'motivasi' => ['required', 'string', 'min:20'],
        'portofolio' => ['required', 'string', 'max:500'],
        'cv' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        'pernyataan' => ['accepted'],
    ];
}

public function messages(): array
{
    return [
        'cv.required' => 'CV wajib diupload',
        'cv.mimes' => 'Format file harus PDF',
        'cv.max' => 'Ukuran file maksimal 2 MB',

        'pernyataan.accepted' => 'Anda harus menyetujui pernyataan',
        'selesai_magang.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai',
    ];
}
}
