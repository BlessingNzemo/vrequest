<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthenticateController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
/*

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $user = User::where('email', $request->email)->first();
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Email ou mot de passe incorrecte!']);
    }
    $token=$user->createToken($request->email)->plainTextToken;
    $user->token =$token ;

    return $user;
});
*/


require __DIR__.'/apiUser.php';

require __DIR__.'/apiMessage.php';
require __DIR__.'/apiMessageGroupe.php';
require __DIR__.'/apiDemande.php';
require __DIR__.'/apiCourse.php';


