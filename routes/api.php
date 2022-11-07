<?php

use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(VideoController::class)->prefix('videos')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{video_id}', 'show');
    Route::put('/{video_id}', 'update');
    Route::delete('/{video_id}', 'destroy');
});
