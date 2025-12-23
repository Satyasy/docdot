<?php

use App\Http\Controllers\Api\RagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

Route::prefix('v1')->group(function () {
    // RAG endpoints
    Route::prefix('rag')->group(function () {
        Route::post('/query', [RagController::class, 'query'])->name('api.rag.query');
        Route::post('/search', [RagController::class, 'search'])->name('api.rag.search');
        Route::get('/stats', [RagController::class, 'stats'])->name('api.rag.stats');
        Route::post('/documents/{document}/process', [RagController::class, 'processDocument'])
            ->name('api.rag.process');
    });
});
