<?php

use App\Http\Controllers\api\AccountController;
use App\Http\Controllers\api\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//アカウント系ルート
Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
    Route::post("login", [AccountController::class, 'login']);
    Route::post('logout', [AccountController::class, 'logout']);
});

//勤怠系ルート
Route::group(['prefix' => 'attendance', 'as' => 'attendance.'], function () {
    Route::post("check", [AttendanceController::class, 'checkAttendanceStatus']);// /api/attendance/check
    Route::post('save', [AttendanceController::class, 'updateAttendanceStatus']);
});
