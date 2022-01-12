<?php

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

Route::get("example", function () {
    return [
        "hello" => "world"
    ];
});

Route::resource("files", \App\Http\Controllers\FilesController::class);
Route::get('/files/{file}', [\App\Http\Controllers\FilesController::class, 'show'])
    ->where('file', '.*');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
