<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    /** @use HasFactory<\Database\Factories\ArtistFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'artists';

    protected $fillable = [ 'name', 'bio', 'email', 'contact', 'picture'];

    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'artist_id');
    }
}
