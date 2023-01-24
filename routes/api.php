<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\ProspectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/reset', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {

    Route::get('/projects', [DashboardController::class, 'projects']);
    Route::get('/project_detail/{project_id}', [DashboardController::class, 'project_detail']);

    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/leads/{project_id}', [ProspectController::class, 'all']);
    Route::post('/leads/{project_id}', [ProspectController::class, 'store']);
    Route::post('/leads/{project_id}/update', [ProspectController::class, 'update']);
    Route::post('/change-status',[ProspectController::class, 'changeStatus']);

    Route::get('/performance/{project_id}', [AuthController::class, 'performance']);
    Route::get('/activity/{project_id}', [AuthController::class, 'activity']);
    Route::get('/archieve/{project_id}', [AuthController::class, 'archieve']);


});
