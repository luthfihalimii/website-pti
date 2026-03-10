<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipApplication extends Model
{
    public const STATUS_BARU = 'baru';

    public const STATUS_DIREVIEW = 'direview';

    public const STATUS_DIPROSES = 'diproses';

    public const STATUS_DITERIMA = 'diterima';

    public const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'nama',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jk',
        'alamat',
        'telp',
        'kelas',
        'sekolah',
        'alamat_sekolah',
        'telp_sekolah',
        'divisi_pilihan',
        'mulai_magang',
        'selesai_magang',
        'motivasi',
        'portofolio',
        'cv_path',
        'cv_disk',
        'status',
        'pernyataan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'mulai_magang' => 'date',
            'selesai_magang' => 'date',
            'pernyataan' => 'boolean',
        ];
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_DIREVIEW => 'Direview',
            self::STATUS_DIPROSES => 'Diproses',
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
            self::STATUS_DIPROSES => 'bg-sky-50 text-sky-700 ring-1 ring-sky-200',
            self::STATUS_DIREVIEW => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
            default => 'bg-slate-100 text-slate-700 ring-1 ring-slate-200',
        };
    }
}
