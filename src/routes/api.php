<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::fallback(function (Request $request) {
    return response()->json([
        'message' => 'Resource not found',
        'status' => 404,
    ], 404);
});
