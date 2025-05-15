<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'playlist_id',
        'identifier',
    ];

    /**
     * Playlist atribuída ao player.
     */
    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }
}
