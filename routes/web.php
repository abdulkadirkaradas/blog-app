<?php

use App\Http\Controllers\Admin\DesignsController;
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
    Route::get('/find-design', [DesignsController::class, "findDesign"]);
    Route::get('/get-all-designs', [DesignsController::class, "getAllDesigns"]);

    // Bag Routes
    Route::post('/store-bag', [DesignsController::class, "store"]);
    Route::post('/update-bag', [DesignsController::class, "update"]);
    Route::post('/delete-bag', [DesignsController::class, "delete"]);
    Route::get('/find-bag', [DesignsController::class, "findBags"]);
    Route::get('/get-all-bags', [DesignsController::class, "getAllBags"]);

    // Blog Routes
    Route::post('/store-blog', [DesignsController::class, "store"]);
    Route::post('/update-blog', [DesignsController::class, "update"]);
    Route::post('/delete-blog', [DesignsController::class, "delete"]);
    Route::get('/find-blog', [DesignsController::class, "findBlog"]);
    Route::get('/get-all-blog', [DesignsController::class, "getAllBlogs"]);
});
