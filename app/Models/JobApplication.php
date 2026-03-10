<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public const STATUS_BARU = 'baru';

    public const STATUS_DIREVIEW = 'direview';

    public const STATUS_DIPANGGIL = 'dipanggil';

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'nama_lengkap',
        'panggilan',
        'email',
        'nomor_telepon',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_pernikahan',
        'golongan_darah',
        'pendidikan_terakhir',
        'jurusan',
        'ipk',
        'posisi',
        'vacancy_slug',
        'pengalaman_kerja',
        'keahlian_khusus',
        'cv_path',
        'cv_disk',
        'status',
        'portofolio',
        'sumber_informasi',
        'gaji_diharapkan',
        'mulai_bekerja',
        'pernyataan_1',
        'pernyataan_2',
        'pernyataan_3',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'mulai_bekerja' => 'date',
            'pernyataan_1' => 'boolean',
            'pernyataan_2' => 'boolean',
            'pernyataan_3' => 'boolean',
        ];
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_DIREVIEW => 'Direview',
            self::STATUS_DIPANGGIL => 'Dipanggil',
            self::STATUS_DITERIMA => 'Diterima',
            self::STATUS_DITOLAK => 'Ditolak',
        ];
    }

    public function statusLabel(): string
    {
        return self::statuses()[$this->status] ?? ucfirst((string) $this->status);
    }

    public function statusClasses(): string
    {
        return match ($this->status) {
            self::STATUS_DITERIMA => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200',
            self::STATUS_DITOLAK => 'bg-red-50 text-red-700 ring-1 ring-red-200',
            self::STATUS_DIPANGGIL => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200',
            self::STATUS_DIREVIEW => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
            default => 'bg-slate-100 text-slate-700 ring-1 ring-slate-200',
        };
    }
}
