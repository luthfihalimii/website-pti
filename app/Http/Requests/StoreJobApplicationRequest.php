<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'panggilan' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'nomor_telepon' => ['required', 'string', 'max:50'],
            'alamat' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'string', 'max:50'],
            'agama' => ['required', 'string', 'max:50'],
            'status_pernikahan' => ['required', 'string', 'max:50'],
            'golongan_darah' => ['required', 'string', 'max:10'],
            'pendidikan_terakhir' => ['required', 'string', 'max:50'],
            'jurusan' => ['required', 'string', 'max:255'],
            'ipk' => ['required', 'string', 'max:20'],
            'posisi' => ['required', 'string', 'max:255'],
            'pengalaman_kerja' => ['required', 'string'],
            'keahlian_khusus' => ['required', 'string'],
            'cv' => ['required', 'file', 'mimetypes:application/pdf', 'max:2048'],
            'portofolio' => ['required', 'string', 'max:500'],
            'sumber_informasi' => ['required', 'string', 'max:100'],
            'gaji_diharapkan' => ['required', 'string', 'max:100'],
            'mulai_bekerja' => ['required', 'date'],
            'pernyataan_1' => ['accepted'],
            'pernyataan_2' => ['accepted'],
            'pernyataan_3' => ['accepted'],
        ];
    }
}
