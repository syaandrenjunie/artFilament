<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;



class Artist extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ArtistFactory> */
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $table = 'artists';

    protected $fillable = [ 'name', 'bio', 'email', 'contact', 'picture'];

    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'artist_id');
    }
}
