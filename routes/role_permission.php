<?php

use App\Http\Middleware\AgentRole;
use App\Http\Middleware\CheckRole;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::get('/test', [TestController::class,'create'])->name('test');


Route::middleware(['authenticate', 'role:admin'])->group(function(){
    Route::get('/saveroles', [RoleController::class,'saveroles']);
    Route::post('/assignRoles/{role}/{user}', [RoleController::class,'assignRoles'])->name('assign_role');
    Route::post('/desactiverRoles/{role}/{user}', [RoleController::class,'desactiverRoles'])->name('desactiver_role');
    Route::post('/assignPermission/{name}/{role}', [PermissionController::class,'assignPermission'])->name('assign_permission');
    Route::post('/desactiverPermission/{name}/{role}', [PermissionController::class,'desactiverPermission'])->name('desactiver_permission');
    Route::resource('/roles',RoleController::class);
    Route::get('/role-as-permission',[RoleController::class,'RoleAsPermissions'])->name('role-as-permission');
    Route::get('/savepermissions', [PermissionController::class,'savepermissions']);
    
    Route::get('/assign_permissions', [PermissionController::class,'assign_permissions']);
    Route::resource('/user_role',UserController::class);
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
});
Route::get('autocomplete',[RegisteredUserController::class,'autocomplete'])->name('autocomplete');

require __DIR__.'/auth.php';