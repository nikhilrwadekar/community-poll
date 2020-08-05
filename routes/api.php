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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// All Polls
Route::get('polls', 'PollsController@index');

// Single Post (with an 'id') - show is standard for view in Laravel
Route::get('polls/{id}', 'PollsController@show');

// Save Poll
Route::post('polls', 'PollsController@store');

// Update Poll
Route::put('polls/{poll}', 'PollsController@update');

// Delete Poll;
Route::delete('polls/{poll}', 'PollsController@delete');

// All Routes except the above!
Route::any('errors', 'PollsController@errors');
