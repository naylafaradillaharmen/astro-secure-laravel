<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\TaskSubmissionController;
use App\Http\Controllers\Api\ScreenTimeRuleController;
use App\Http\Controllers\Api\ScreenTimeLogController;
use App\Http\Controllers\Api\ChildProgressController;
use App\Http\Controllers\Api\DailyRewardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    /*
    |--------------------------------------------------------------------------
    | Schedule
    |--------------------------------------------------------------------------
    */

    Route::apiResource('schedules', ScheduleController::class);

    /*
    |--------------------------------------------------------------------------
    | Task Submission
    |--------------------------------------------------------------------------
    */

    Route::apiResource('task-submissions', TaskSubmissionController::class);

    /*
    |--------------------------------------------------------------------------
    | Screen Time Rules
    |--------------------------------------------------------------------------
    */

    Route::apiResource('screen-time-rules', ScreenTimeRuleController::class);

    /*
    |--------------------------------------------------------------------------
    | Screen Time Logs
    |--------------------------------------------------------------------------
    */

    Route::apiResource('screen-time-logs', ScreenTimeLogController::class);

    /*
    |--------------------------------------------------------------------------
    | Child Progress
    |--------------------------------------------------------------------------
    */

    Route::apiResource('child-progress', ChildProgressController::class);

    /*
    |--------------------------------------------------------------------------
    | Daily Rewards
    |--------------------------------------------------------------------------
    */

    Route::get('/daily-rewards/today', [DailyRewardController::class, 'today']);

    Route::apiResource('daily-rewards', DailyRewardController::class);
});