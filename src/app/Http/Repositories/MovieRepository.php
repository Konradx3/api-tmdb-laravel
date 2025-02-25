<?php

namespace App\Http\Repositories;

use App\Models\V1\Movie;

class MovieRepository
{
    public function getAll(string $lang)
    {
        return Movie::all()->map(function ($movie) use ($lang) {
            $movie->title = $movie->getTranslation('title', $lang);
            $movie->overview = $movie->getTranslation('overview', $lang);
            return $movie;
        });
    }
}
