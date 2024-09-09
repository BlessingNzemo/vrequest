<?php
use App\Http\Controllers\Api\ApiCourseController;
use Illuminate\Support\Facades\Route;

Route::post('course/status',[ApiCourseController::class,'statusCourse']);