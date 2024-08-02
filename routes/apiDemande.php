<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiDemandeController;
Route::apiResource('/demandes', ApiDemandeController::class);
Route::post('user-demande',[ApiDemandeController::class,'userDemande']);
Route::post('last-demande',[ApiDemandeController::class,'lastDemande']);
Route::post('getdemande',[ApiDemandeController::class,'getdemande']);
