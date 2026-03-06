<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInternshipStepTwoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'divisi_pilihan' => ['required', 'string', 'max:255'],
            'mulai_magang' => ['required', 'date'],
            'selesai_magang' => ['required', 'date', 'after_or_equal:mulai_magang'],
            'motivasi' => ['required', 'string', 'min:20'],
            'portofolio' => ['required', 'string', 'max:500'],
            'cv' => ['required', 'file', 'mimetypes:application/pdf', 'max:2048'],
            'pernyataan' => ['accepted'],
        ];
    }
}
