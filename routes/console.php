<?php

use App\Models\Delegation;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $delegations = Delegation::get();
    foreach ($delegations as $delegation){
        if($delegation->date_fin->toDateTimeString() < date('Y-m-d H:i:s') ){
            $delegation->status = 0;
            $delegation->update();
        }
    }
    
})->everyMinute();