<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'employment_type',
        'headline',
        'summary',
        'description',
        'qualifications',
        'skills',
        'salary_range',
        'salary_note',
        'salary_context',
        'benefits',
        'poster_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'qualifications' => 'array',
            'skills' => 'array',
            'benefits' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }
}
