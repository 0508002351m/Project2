<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\postsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;


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

Route::resource('/users' , userController::class);
Route::resource('/posts' , postsController::class);
Route::resource('/comments' , commentController::class);
Route::resource('/like' , likeController::class);

//  Route::get('User',[userController::class,'index']);
// Route::get('User/Edit/{id}',[userController::class,'edit']);
// Route::post('User/Update',[userController::class,'update']);
// Route::get('User/Destroy/{id}',[userController::class,'destroy']);

// Route::get('User/Create', [userController::class, 'create']);
// Route::post('User/Register', [userController::class, 'store']);

// Route::get('Login',[userController::class,'login']);
// Route::post('DoLogin',[userController::class,'doLogin']);
// Route::get('LogOut',[userController::class,'logOut']);

#######################################################################
//post operations
// Route::get('post',[postsController::class,'index']);
// Route::get('post/Edit/{id}',[postsController::class,'edit']);
// Route::post('post/Update',[postsController::class,'update']);
// Route::get('post/Destroy/{id}',[postsController::class,'destroy']);
// Route::post('post/store', [postsController::class, 'store']);

// Route::get('post/Create', [postsController::class, 'create']);

###########################################################################
//comment operations
// Route::get('comment',[commentController::class,'index']);
// Route::get('comment/Edit/{id}',[commentController::class,'edit']);
// Route::post('comment/Update',[commentController::class,'update']);
// Route::get('comment/Destroy/{id}',[commentController::class,'destroy']);
// Route::post('comment/store', [commentController::class, 'store']);

// Route::get('comment/Create', [commentController::class, 'create']);


