<?php

namespace App\Http\Repositories;

use App\Models\V1\Genre;

class GenreRepository
{
    public function getAll(string $lang)
    {
        return Genre::all()->map(function ($genre) use ($lang) {
            $genre->name = $genre->getTranslation('name', $lang);
            return $genre;
        });
    }
}
