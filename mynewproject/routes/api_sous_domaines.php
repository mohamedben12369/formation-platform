<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SousDomaineController;

Route::post('/sous-domaines', [SousDomaineController::class, 'apiStore']);
Route::get('/domaines/{domaineId}/sous-domaines', [SousDomaineController::class, 'getSousDomainesParDomaine'])
    ->name('api.sous-domaines.par-domaine')
    ->withoutMiddleware(['auth']);
