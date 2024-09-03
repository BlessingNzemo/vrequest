<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\DemandeController;
use Illuminate\Support\Facades\Route;

Route::middleware('authenticate')->group(function(){
Route::get('/site/{nom}', [SiteController::class, 'getCoordinates']);
Route::resource('/demandes', DemandeController::class);

Route::post('/sites', [SiteController::class, 'store'])->name('sites');
Route::get('/site', [SiteController::class,'index'])->name('site');

Route::get('/demande-collaborateurs',[DemandeController::class,'demandeCollaborateurs'])->name('demande-collaborateurs');
Route::get('/envoyerMailAuManager/{id}',[DemandeController::class,'envoyerMailManager'])->name('envoyermailmanager');
Route::post('/envoyermailauchefcharroi/{id}',[DemandeController::class,'envoyerMailAuChefCharroi'])->name('envoyermailauchefcharroi');
Route::post('/mailAnnulationDemandeParLeManager/{id}',[DemandeController::class,'mailAnnulationDemandeParLeManager'])->name('annulationmailparmanager');
Route::get('/demande-charroi',[DemandeController::class,'demandeCharroi'])->name('demandeCharroi');
Route::post('/rejetDemandeParCharroi/{id}',[DemandeController::class,'rejetDemandeParCharroi'])->name('rejetDemandeParCharroi');
Route::get('/demande-delegue',[DemandeController::class,'demandeDelegue'])->name('demandeDelegue');
});


