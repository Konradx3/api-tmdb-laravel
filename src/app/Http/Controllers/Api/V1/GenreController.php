<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\GenreRepository;
use App\Http\Resources\V1\GenreResource;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    use ApiResponses;

    protected GenreRepository $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
    * Retrieve a list of genres.
    *
    * @param Request $request HTTP request instance.
    * @return JsonResponse JSON response with genres data or error message.
    */
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');
        $genres = $this->genreRepository->getAll($lang);

        if ($genres->isEmpty())
        {
            return $this->error('No genres found', 404);
        }

        return $this->ok('Genres retrieved successfully', GenreResource::collection($genres)->toArray($request));
    }
}
