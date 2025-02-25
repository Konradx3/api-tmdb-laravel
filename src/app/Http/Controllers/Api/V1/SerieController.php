<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SerieRepository;
use App\Http\Resources\V1\SerieResource;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    use ApiResponses;

    protected SerieRepository $serieRepository;

    public function __construct(SerieRepository $serieRepository)
    {
        $this->serieRepository = $serieRepository;
    }

    /**
     * Retrieve a list of series.
     *
     * @param Request $request HTTP request instance.
     * @return JsonResponse JSON response with series data or error message.
     */
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en');
        $series = $this->serieRepository->getAll($lang);

        if ($series->isEmpty()) {
            return $this->error('No series found', 404);
        }

        return $this->ok('Series retrieved successfully', SerieResource::collection($series)->toArray($request));

    }
}
