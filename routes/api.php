<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\TaskSubmissionController;
use App\Http\Controllers\Api\ScreenTimeRuleController;
use App\Http\Controllers\Api\ScreenTimeLogController;
use App\Http\Controllers\Api\RewardRequestController;
use App\Http\Controllers\Api\RewardResponseController;
use App\Http\Controllers\Api\ChildProgressController;

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
    | Reward Requests
    |--------------------------------------------------------------------------
    */

    Route::apiResource('reward-requests', RewardRequestController::class);

    /*
    |--------------------------------------------------------------------------
    | Reward Responses
    |--------------------------------------------------------------------------
    */

    Route::apiResource('reward-responses', RewardResponseController::class);

    /*
    |--------------------------------------------------------------------------
    | Child Progress
    |--------------------------------------------------------------------------
    */

    Route::apiResource('child-progress', ChildProgressController::class);
});