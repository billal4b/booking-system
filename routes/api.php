<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeetingScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



 //Route::apiResource('booking', MeetingScheduleController::class);

Route::get('booking', [MeetingScheduleController::class, 'index']);
Route::post('booking', [MeetingScheduleController::class, 'store']);
Route::get('booking/{id}', [MeetingScheduleController::class, 'show']);
Route::put('booking/{id}/edit', [MeetingScheduleController::class, 'update']);
Route::delete('booking/{id}/delete', [MeetingScheduleController::class, 'destroy']);
