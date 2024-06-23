<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebSiteController;
use App\Http\Controllers\SubscriptionController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });


Route::controller(WebSiteController::class)->group(function () {
  // Create WebSites
  Route::post('/create/website', 'create')->name('create-website');

  //Fetch Websites
  Route::get('/websites', 'index')->name('index-website');
});


Route::controller(PostController::class)->group(function () {
  //Create a "post" for a "particular website"
  Route::post('/websites/{website}/posts', 'create')->name('create-website');

  //Fetch all "posts" for a "particular website"
  Route::get('/websites/{website}/posts', 'index')->name('index-website');
});


Route::controller(SubscriptionController::class)->group(function () {
  //User subscribe to a "particular website" 
  Route::post('/websites/{website}/subscribe', 'subscribe')->name('subscribe-website');
});