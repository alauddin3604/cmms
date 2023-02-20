<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\API\AssetController;
use App\Http\Controllers\API\SupervisorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
//use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WorkOrderHistoryController;

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

Route::group(['prefix' => 'technician'], function () {
    Route::post('add', [TechnicianController::class, 'add']);
    Route::get('edit/{id}', [TechnicianController::class, 'edit']);
    Route::post('update/{id}', [TechnicianController::class, 'update']);
    Route::delete('multiDelete/{supervisors}', [TechnicianController::class, 'multiDelete']);
});

Route::group(['prefix' => 'work_order'], function () {
    Route::post('add', [WorkOrderController::class, 'add']);
    Route::get('check/{asset_id}', [WorkOrderController::class, 'check']);
});

Route::delete('/assets/multiDelete/{assets}', [AssetController::class, 'multiDelete']);
Route::apiResource('assets', AssetController::class);
Route::apiResource('supervisors', SupervisorController::class);
Route::apiResources(['technician' => TechnicianController::class]);
Route::apiResources(['work_order' => WorkOrderController::class]);
Route::apiResources(['work-order-histories' => WorkOrderHistoryController::class]);
