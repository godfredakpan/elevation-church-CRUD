<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;

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

Route::apiResource('/users', UsersController::class);

// Route::group(['prefix' => 'v1',],  function () {
//     Route::post('account-type', 'OnboardController@updateAccount')->name('update.account-type');
//     Route::post('profile', 'OnboardController@updateProfile')->name('update.profile');

// });
