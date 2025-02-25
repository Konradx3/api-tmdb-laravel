<?php

use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\SerieController;
use App\Http\Controllers\Api\V1\GenreController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/movies', [MovieController::class, 'index']);

    Route::get('/series', [SerieController::class, 'index']);

    Route::get('/genres', [GenreController::class, 'index']);
});
