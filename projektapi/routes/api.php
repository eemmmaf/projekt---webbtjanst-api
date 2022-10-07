<?php

use App\Http\Controllers\AuthController;
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
Route::post('/addproduct/{id}', [ProductController::class, 'addProduct'])->middleware('auth:sanctum'); //Lägger till en produkt
Route::post('/addcategory', [ProductController::class, 'addCategory'])->middleware('auth:sanctum');  //Lägger till en kategori
//Get-routes
Route::get('/getproducts', [ProductController::class, 'getProducts'])->middleware('auth:sanctum'); //Hämtar alla produkter
Route::get('/getcategories', [ProductController::class, 'getCategories'])->middleware('auth:sanctum');  //Hämtar alla kategorier
Route::get('/getproductbyid/{id}', [ProductController::class, 'getProductById'])->middleware('auth:sanctum'); //Hämtar enskild produkt
Route::get('/products/search/{name}', [ProductController::class, 'searchProduct'])->middleware('auth:sanctum'); //Söka efter produkt efter namn
//Put-routes
Route::put('/updateproduct/{id}', [ProductController::class, 'updateProduct'])->middleware('auth:sanctum');  //Lägger till en produkt
//Delete-route
Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');  //Lägger till en produkt

//Route för att registrera (Publik)
Route::post('/register', [AuthController::class, 'register']);
//Route för att logga in
Route::post('/login', [AuthController::class, 'login']);
//Route för att logga ut
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
