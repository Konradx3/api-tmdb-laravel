<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Serie extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'overview', 'first_air_date', 'poster_path', 'tmdb_id'];
    public $translatable = ['title', 'overview'];
}
