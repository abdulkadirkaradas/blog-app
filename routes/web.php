<?php

use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\DesignsController;
use App\Http\Controllers\Admin\BagsController;
use App\Http\Controllers\Admin\BlogController;
use App\HTTP\Controllers\Admin\HomeController;
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

    // Design Routes
    Route::post('/store-design', [DesignsController::class, "store"]);
    Route::post('/update-design', [DesignsController::class, "update"]);
    Route::post('/delete-design', [DesignsController::class, "delete"]);
    Route::get('/find-design/{id}', [DesignsController::class, "findDesign"]);
    Route::get('/get-all-designs', [DesignsController::class, "getAllDesigns"]);

    // Bag Routes
    Route::post('/store-bag', [BagsController::class, "store"]);
    Route::post('/update-bag', [BagsController::class, "update"]);
    Route::post('/delete-bag', [BagsController::class, "delete"]);
    Route::get('/find-bag/{id}', [BagsController::class, "findBag"]);
    Route::get('/get-all-bags', [BagsController::class, "getAllBags"]);

    // Blog Routes
    Route::post('/store-blog', [BlogController::class, "store"]);
    Route::post('/update-blog', [BlogController::class, "update"]);
    Route::post('/delete-blog', [BlogController::class, "delete"]);
    Route::get('/find-blog/{id}', [BlogController::class, "findBlog"]);
    Route::get('/get-all-blogs', [BlogController::class, "getAllBlogs"]);

    // Social Media
    Route::post('/store-sm', [SocialMediaController::class, "store"]);
    Route::post('/update-sm', [SocialMediaController::class, "update"]);
    Route::post('/delete-sm', [SocialMediaController::class, "delete"]);
    Route::get('/find-sm/{id}', [SocialMediaController::class, "findSM"]);
    Route::get('/get-all-sm', [SocialMediaController::class, "getAllSMs"]);
});
