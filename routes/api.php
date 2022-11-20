<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LbsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TournamentController;

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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::get('/user', [LbsController::class, 'user']);
    Route::apiResource('tournament', TournamentController::class);
    Route::put('tournament/{id}', [TournamentController::class, 'update']);
    Route::delete('tournament/{id}', [TournamentController::class, 'destroy']);
    Route::get('game/{id}', [GameController::class, 'show']);
    Route::apiResource('game', GameController::class);
    Route::put('game', [GameController::class, 'update']);
    Route::delete('game', [GameController::class, 'destroy']);
    Route::post('send-mail', [MailController::class, 'index']);
});
