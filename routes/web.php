<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/sidemenu/user/profile', [\App\Http\Controllers\SideMenuController::class, 'profile'])
        ->name('user_profile');

    Route::post('/company/coyProfile',[\App\Http\Controllers\CompanyController::class, 'coyProfile'])
    ->name('coyProfile');


    //shows the view for the category and product
    Route::get('/cat_and_prod',[\App\Http\Controllers\CategoryController::class, 'index'])
        ->name('cat_and_prod');

    Route::namespace('Category')->prefix('category')->name('category')->group(function(){
        //create a new category for product
       Route::post('/create',[\App\Http\Controllers\CategoryController::class, 'createCategory']);
    });

    Route::name('product')->group(function(){
        Route::resource('products', ProductController::class);
    });

});



//Route::resource('/users', UserController::class);


