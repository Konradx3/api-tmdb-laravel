<?php

namespace App\Http\Repositories;

use App\Models\V1\Genre;
use Illuminate\Support\Collection;

class GenreRepository
{
    /**
     * Retrieve all genres with translations.
     *
     * @param string $lang Language code for translation.
     * @return Collection Collection of genres with translated names.
     */
    public function getAll(string $lang): Collection
    {
        return Genre::all()->map(function ($genre) use ($lang) {
            $genre->name = $genre->getTranslation('name', $lang);
            return $genre;
        });
    }
}
