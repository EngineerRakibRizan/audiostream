<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'artist_id', 'title', 'lyrics', 'youtube_link', 'slug'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'id');
    }
}
