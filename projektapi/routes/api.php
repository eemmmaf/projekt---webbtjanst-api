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

//Post-routes
Route::post('/addproduct/{id}', [ProductController::class, 'addProduct']); //Lägger till en produkt
Route::post('/addcategory', [ProductController::class, 'addCategory']); //Lägger till en kategori
//Get-routes
Route::get('/getproducts', [ProductController::class, 'getProducts']); //Hämtar alla produkter
Route::get('/getcategories', [ProductController::class, 'getCategories']); //Hämtar alla kategorier
Route::get('/getproductbyid/{id}', [ProductController::class, 'getProductById']); //Hämtar enskild produkt
//Put-routes
Route::put('/updateproduct/{id}', [ProductController::class, 'updateProduct']); //Lägger till en produkt
//Delete-route
Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy']); //Lägger till en produkt




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
