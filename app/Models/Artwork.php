<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    /** @use HasFactory<\Database\Factories\ArtworkFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'artworks';

    protected $fillable = [ 'title', 'price', 'picture', 'artist_id', 'category_id'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
