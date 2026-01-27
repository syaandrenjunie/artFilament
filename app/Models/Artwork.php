<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ArtworkFactory> */
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

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
