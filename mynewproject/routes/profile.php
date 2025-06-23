<?php

use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Profile\ExperienceController;
use App\Http\Controllers\Profile\CompetenceController;
use App\Http\Controllers\Profile\DiplomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {    Route::prefix('profile')->name('profile.')->group(function () {
        // Routes du profil
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [ProfileController::class, 'show'])->name('show');
        
        // Routes pour les photos de profil
        Route::post('/photo', [ProfileController::class, 'updateProfilePhoto'])->name('photo.update');
        Route::delete('/photo', [ProfileController::class, 'deleteProfilePhoto'])->name('photo.delete');

        // Routes pour les photos de fond
        Route::post('/background', [ProfileController::class, 'updateBackgroundPhoto'])->name('background.update');
        Route::delete('/background', [ProfileController::class, 'deleteBackgroundPhoto'])->name('background.delete');
        
        // Routes des compétences
        Route::resource('competences', CompetenceController::class);
        
        // Routes des expériences
        Route::resource('experiences', ExperienceController::class);
        Route::get('/experiences/{experience}/attestation', [ExperienceController::class, 'showAttestation'])->name('experiences.attestation');
        
        // Routes des diplômes
        Route::resource('diplomes', DiplomeController::class);
        Route::get('/diplomes/{diplome}/certificat', [DiplomeController::class, 'showCertificate'])->name('diplomes.certificat');
    });
});
