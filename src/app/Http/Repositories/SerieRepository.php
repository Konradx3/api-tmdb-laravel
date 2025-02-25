<?php

namespace App\Http\Repositories;

use App\Models\V1\Serie;
use Illuminate\Support\Collection;

class SerieRepository
{
    /**
     * Retrieve all series with translations.
     *
     * @param string $lang Language code for translation.
     * @return Collection Collection of series with translated titles and overviews.
     */
    public function getAll(string $lang): Collection
    {
        return Serie::all()->map(function ($serie) use ($lang) {
            $serie->title = $serie->getTranslation('title', $lang);
            $serie->overview = $serie->getTranslation('overview', $lang);
            return $serie;
        });
    }
}
