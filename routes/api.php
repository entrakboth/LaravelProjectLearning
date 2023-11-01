<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserAccController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\GodController;
use \App\Http\Controllers\RankController;
use \App\Http\Controllers\KingdomController;
use \App\Http\Controllers\CitiesController;
use \App\Http\Controllers\CountryController;
use \App\Http\Controllers\StateController;
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

// JWT concept
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user', 'getUserData');
});

// TODO controller
Route::controller(TodoController::class)->group(function () {
    Route::get('todos/index', 'index');
    Route::post('todo/store', 'store');
    Route::get('todo/show/{id}', 'show');
    Route::put('todo/update/{id}', 'update');
    Route::delete('todo/delete/{id}', 'destroy');
});


// update coin controller
Route::group(['prefix' => 'coin'], function () {
    Route::get('index', [CoinController::class, 'index']);
    Route::post('store', [CoinController::class, 'store']);
    Route::get('show/{id}', [CoinController::class, 'show']);
    Route::put('edit/{id}', [CoinController::class, 'edit']);
    Route::get('sub-category/{id}', [CoinController::class, 'sub_category']);
    Route::get('all-sub-categories', [CoinController::class, 'get_all_subs']);
    Route::post('update/{id}', [CoinController::class, 'update']);
    Route::delete('delete/{id}', [CoinController::class, 'destroy']);
    Route::post('search', [CoinController::class, 'searchByName']);
    Route::post('searchByQuery', [ CoinController::class, 'querySearch']);
});

// Category controller
Route::group(['prefix' => 'category'], function () {
    Route::get('index', [CategoryController::class, 'index']);
});

// User account api
Route::controller(UserAccController::class)->group( function (){
    Route::get('user-acc/index', 'index');
    Route::get('user-acc/show/{id}', 'show');
    Route::post('user-acc/store', 'store');
    Route::put('user-acc/update/{id}', 'update');
    Route::delete('user-acc/delete/{id}', 'destroy');
});

// Type controller
Route::controller(TypeController::class)->group(function () {
    Route::get('type/index', 'index');
    Route::post('type/store', 'store');
    Route::put('type/edit/{id}', 'edit');
    Route::post('type/update/{id}', 'update');
    Route::delete('type/delete/{id}', 'destroy');
});

// one-to-one table
Route::controller(GodController::class)->group(function () {
    Route::get('God/index', 'index');
    Route::get('God/GetSub', 'Get_All');
    Route::post('God/store', 'store');
    Route::post('God/find/{id}', 'getSubWithId');
    Route::delete('God/delete/{id}', 'destroy');

});

// get all one-to-one
Route::controller(RankController::class)->group(function () {
    Route::get('rank/index', 'index');
    Route::get('rank/getAll', 'getAll');
    Route::post('rank/store/{id}', 'store');
});

// get all one-to-many
Route::controller(KingdomController::class)->group(function () {
    Route::get('kingdoms/index', 'index');
    Route::get('kingdoms/getAll', 'getCities');
    Route::post('kingdoms/store', 'store');
    Route::put('kingdoms/edit/{id}', 'edit');
    Route::delete('kingdoms/destroy/{id}', 'destroy');

});
// get all one-to-many
Route::controller(CitiesController::class)->group(function () {
    Route::get('cities/index', 'index');
    Route::get('cities/getAll', 'getKingdoms');
    Route::post('cities/store/{id}', 'store');

});


// country and state
Route::controller(CountryController::class)->group(function (){
    Route::get('getAllCountryS/index', 'index');
    Route::get('Country/GetAllState', 'GetState');
    Route::post('Country/GetAllCambodia', 'getCambodiaState');
    Route::post('Country/GetAllStatebyID/{id}', 'getStateById');

});

// State controller
Route::controller(StateController::class)->group(function (){
   Route::get("getAllState", 'index');
});
