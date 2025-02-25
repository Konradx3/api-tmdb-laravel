<?php

namespace App\Http\Repositories;

use App\Models\V1\Serie;

class SerieRepository
{
    public function getAll(string $lang)
    {
        return Serie::all()->map(function ($serie) use ($lang) {
            $serie->title = $serie->getTranslation('title', $lang);
            $serie->overview = $serie->getTranslation('overview', $lang);
            return $serie;
        });
    }
}
