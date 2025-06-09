<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_at', 'end_at'];

    /**
     * The contents that belong to the playlist.
     */
   public function contents()
{
    return $this->belongsToMany(Content::class, 'playlist_content') // Adicionei 'playlist_content' aqui
                ->withPivot('order')
                ->orderBy('playlist_content.order');
}

    /**
     * Scope to get active contents for preview, ordered by 'order' field.
     */
    public function getPreviewContents()
    {
        $now = now();

        return $this->contents()
            ->where(function ($query) use ($now) {
                $query->whereNull('start_at')->orWhere('start_at', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_at')->orWhere('end_at', '>=', $now);
            })
            ->orderBy('order', 'asc')
            ->get();
    }
}