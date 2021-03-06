<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/modules/{modules}/lessons', LessonController::class);
Route::apiResource('/courses/{courses}/modules', ModuleController::class);

Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{identify}', [CourseController::class, 'destroy']);
Route::get('/courses/{identify}', [CourseController::class, 'show']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses', [CourseController::class, 'index']);


Route::get('/', function () {
    return response()->json(['message' => 'OK']);
});
