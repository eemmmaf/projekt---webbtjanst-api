<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::post('/addproduct/{id}', [ProductController::class, 'addProduct']);
Route::post('/addcategory', [ProductController::class, 'addCategory']);
Route::get('/getproducts', [ProductController::class, 'getProducts']);
Route::get('/getcategories', [ProductController::class, 'getCategories']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
