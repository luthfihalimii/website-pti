<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInternshipStepOneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'nisn' => ['required', 'string', 'max:50'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jk' => ['required', 'in:Laki-laki,Perempuan'],
            'alamat' => ['required', 'string', 'max:500'],
            'telp' => ['required', 'string', 'max:50'],
            'kelas' => ['required', 'in:X,XI,XII,D3,S1'],
            'sekolah' => ['required', 'string', 'max:255'],
            'alamat_sekolah' => ['required', 'string', 'max:500'],
            'telp_sekolah' => ['required', 'string', 'max:50'],
        ];
    }
}
