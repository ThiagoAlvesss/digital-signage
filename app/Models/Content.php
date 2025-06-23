<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'path',
        'text',
        'start_at',
        'end_at'
    ];

    /**
     * Scope para filtrar conteúdos ativos conforme agendamento.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        $now = now();

        return $query->where(function ($query) use ($now) {
            $query->whereNull('start_at')->orWhere('start_at', '<=', $now);
        })->where(function ($query) use ($now) {
            $query->whereNull('end_at')->orWhere('end_at', '>=', $now);
        });
    }
}

