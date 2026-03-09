<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'agama' => ['required', Rule::in(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'])],
            'status_pernikahan' => ['required', Rule::in(['Belum Menikah', 'Menikah', 'Cerai'])],
            'golongan_darah' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            'pendidikan_terakhir' => ['required', Rule::in(['SMA/SMK', 'D3', 'S1', 'S2', 'S3'])],
            'jurusan' => ['required', 'string', 'max:255'],
            'ipk' => ['required', 'string', 'max:20'],
            'posisi' => ['required', 'string', 'max:255'],
            'pengalaman_kerja' => ['required', 'string'],
            'keahlian_khusus' => ['required', 'string'],
            'cv' => ['required', 'file', 'mimetypes:application/pdf', 'max:2048'],
            'portofolio' => ['required', 'string', 'max:500'],
            'sumber_informasi' => ['required', Rule::in(['Website Perusahaan', 'Media Sosial', 'Teman/Keluarga', 'Job Portal', 'Lainnya'])],
            'gaji_diharapkan' => ['required', 'string', 'max:100'],
            'mulai_bekerja' => ['required', 'date'],
            'pernyataan_1' => ['accepted'],
            'pernyataan_2' => ['accepted'],
            'pernyataan_3' => ['accepted'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $vacancy = Arr::first(
            config('site.careers.vacancies', []),
            fn (array $vacancy): bool => ($vacancy['slug'] ?? Str::slug($vacancy['title'])) === $this->route('slug'),
        );

        if (is_array($vacancy)) {
            $this->merge([
                'posisi' => $vacancy['title'],
            ]);
        }
    }
}
