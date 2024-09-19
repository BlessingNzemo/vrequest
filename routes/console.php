<?php

use App\Models\Demande;
use App\Models\Delegation;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $delegations = Delegation::get();
    $demandes = Demande::get();
    foreach ($delegations as $delegation){
        if(($delegation->date_debut->toDateTimeString() > date('Y-m-d H:i:s'))||($delegation->date_fin->toDateTimeString() < date('Y-m-d H:i:s')) ){
            $delegation->status = 0;
            $delegation->update();
        }
    }
    
    foreach ($demandes as $demande){
        if($demande->date_deplacement->toDateTimeString() < date('Y-m-d H:i:s')){
            if($demande->is_validated == 0){
                $demande->is_validated = 2;
                $demande->status = '2';
                $demande->raison = "La demande a expiré!";
                $demande->update();
            }
            else if($demande->status == '0'){
                $demande->status = '2';
                $demande->raison = "La demande a expiré!";
                $demande->update();
            }
        }
    }
})->everyMinute();
    
    
