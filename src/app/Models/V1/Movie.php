<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'overview', 'release_date', 'poster_path', 'tmdb_id'];
    public $translatable = ['title', 'overview'];
}
