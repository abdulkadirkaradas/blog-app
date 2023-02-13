<?php

use App\Http\Controllers\Admin\SocialMediaController;
// use App\Http\Controllers\Admin\DesignsController;
// use App\Http\Controllers\Admin\BagsController;
// use App\Http\Controllers\Admin\BlogController;
use App\HTTP\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TopicsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get("/", function () {
    return view("site.main");
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function() {
    Route::get("/", [HomeController::class, 'index'])->name("home");

    //Topic Routes
    Route::post('/store-topic', [TopicsController::class, "store"]);
    Route::post('/update-topic/{id}', [TopicsController::class, "update"]);
    Route::post('/delete-topic/{id}', [TopicsController::class, "delete"]);
    Route::get('/find-topic/{id}', [TopicsController::class, "findTopic"]);
    Route::get('/get-all-topics/{flag}', [TopicsController::class, "getAllTopics"]);

    // Social Media
    Route::post('/store-sm', [SocialMediaController::class, "store"]);
    Route::post('/update-sm/{id}', [SocialMediaController::class, "update"]);
    Route::post('/delete-sm/{id}', [SocialMediaController::class, "delete"]);
    Route::get('/find-sm/{id}', [SocialMediaController::class, "findSM"]);
    Route::get('/get-all-sm', [SocialMediaController::class, "getAllSMs"]);
});
