<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'start_at', 'end_at'];

    /**
     * The contents that belong to the playlist.
     */
    public function contents()
    {
        return $this->belongsToMany(Content::class, 'playlist_content');
    }
    // Para Content.php e Playlist.php
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
