<?php

namespace App\Services;

use App\Models\V1\Genre;
use App\Models\V1\Movie;
use App\Models\V1\Serie;
use Illuminate\Support\Facades\Http;

class TMDBService
{
    protected string $apiKey;
    protected array $languages = ['pl', 'en', 'de'];

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');

        if (!$this->validateApiKey()) {
            throw new \Exception("Key authentication failed. Check your API key in the configuration file");
        }
    }

    protected function validateApiKey(): bool
    {
        $response = Http::get("https://api.themoviedb.org/3/authentication", [
            'api_key' => $this->apiKey,
        ]);

        $data = $response->json();

        return isset($data['success']) && $data['success'];
    }

    public function fetchData(string $type, ?int $limit = null): void
    {
        foreach ($this->languages as $lang) {
            $count = 0;

            foreach ($this->getDataFromApi($type, $lang) as $item) {
                $this->saveData($type, $item, $lang);
                $count++;

                if ($limit !== null && $count >= $limit) {
                    break;
                }
            }
        }
    }

    protected function getDataFromApi(string $type, string $lang): \Generator
    {
        $endpoints = [
            'movies' => 'movie/popular',
            'series' => 'tv/popular',
            'genres' => 'genre/movie/list',
        ];

        if (!isset($endpoints[$type])) {
            throw new \InvalidArgumentException("Unknown data type: $type");
        }

        $page = 1;
        while (true) {
            $response = Http::get("https://api.themoviedb.org/3/{$endpoints[$type]}", [
                'api_key' => $this->apiKey,
                'language' => $lang,
                'page' => $page,
            ]);

            if (!$response->successful()) {
                break;
            }

            $resultsKey = $type === 'genres' ? 'genres' : 'results';
            $data = $response->json()[$resultsKey] ?? [];

            if (empty($data)) {
                break;
            }

            foreach ($data as $item) {
                yield $item;
            }

            $page++;
        }
    }

    protected function saveData(string $type, array $item, string $lang): void
    {
        $models = [
            'movies' => Movie::class,
            'series' => Serie::class,
            'genres' => Genre::class,
        ];

        if (!isset($models[$type])) {
            throw new \InvalidArgumentException("Unknown data type: $type");
        }

        $modelClass = $models[$type];

        $fields = match ($type) {
            'movies' => [
                'tmdb_id' => $item['id'],
                'release_date' => $item['release_date'],
                'poster_path' => $item['poster_path']
            ],
            'series' => [
                'tmdb_id' => $item['id'],
                'first_air_date' => $item['first_air_date'],
                'poster_path' => $item['poster_path']
            ],
            'genres' => [
                'tmdb_id' => $item['id']
            ],
            default => throw new \InvalidArgumentException("Unknown data type: $type"),
        };

        $dbItem = $modelClass::updateOrCreate(['tmdb_id' => $item['id']], $fields);

        $translations = match ($type) {
            'movies' => [
                'title' => $item['title'],
                'overview' => $item['overview']
            ],
            'series' => [
                'title' => $item['name'],
                'overview' => $item['overview']
            ],
            'genres' => [
                'name' => $item['name']
            ],
            default => [],
        };

        foreach ($translations as $field => $value) {
            $dbItem->setTranslation($field, $lang, $value);
        }

        $dbItem->save();
    }
}
