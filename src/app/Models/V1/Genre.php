<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Genre extends Model
{
    use HasTranslations;

    protected $fillable = ['name', 'tmdb_id'];
    public $translatable = ['name'];
}
