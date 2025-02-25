<?php

namespace App\Http\Repositories;

use App\Models\V1\Movie;
use Illuminate\Support\Collection;

class MovieRepository
{
    /**
     * Retrieve all movies with translations.
     *
     * @param string $lang Language code for translation.
     * @return Collection Collection of movies with translated titles and overviews.
     */
    public function getAll(string $lang): Collection
    {
        return Movie::all()->map(function ($movie) use ($lang) {
            $movie->title = $movie->getTranslation('title', $lang);
            $movie->overview = $movie->getTranslation('overview', $lang);
            return $movie;
        });
    }
}
