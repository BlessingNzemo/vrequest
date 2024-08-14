<?php

use App\Models\User;
use App\Models\Delegation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Notifications\ChefCharroiEmail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('authenticate');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('authenticate');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard')->middleware('authenticate');

Route::middleware('authenticate')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
   
});

Route::get('/test',function(){
    $delegations = Delegation::get();
    foreach ($delegations as $delegation){
        if($delegation->date_fin->toDateTimeString() < date('Y-m-d H:i:s') ){
            $delegation->status = 0;
            $delegation->update();
        }
    }
})->name('test');




require __DIR__.'/auth.php';
require __DIR__.'/demande_web.php';
require __DIR__.'/route_vccourse.php';
require __DIR__.'/role_permission.php';
require __DIR__.'/delegation_web.php';

