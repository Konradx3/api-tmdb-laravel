<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\MovieRepository;
use App\Http\Resources\V1\MovieResource;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    use ApiResponses;

    protected MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');
        $movies = $this->movieRepository->getAll($lang);

        if ($movies->isEmpty())
        {
            return $this->error('No movies found', 404);
        }

        return $this->ok('Movies retrieved successfully', MovieResource::collection($movies)->toArray($request));

    }
}
