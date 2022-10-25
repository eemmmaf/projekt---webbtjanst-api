<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;



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

//Kategori-routes
Route::post('/addcategory', [CategoryController::class, 'addCategory'])->middleware('auth:sanctum');  //Lägger till en kategori
Route::get('/getcategories', [CategoryController::class, 'getCategories'])->middleware('auth:sanctum');  //Hämtar alla kategorier
Route::get('/getcategory/{id}', [CategoryController::class, 'getCategoryById'])->middleware('auth:sanctum');  //Hämtar alla kategorier
Route::put('/updatecategory/{id}', [CategoryController::class, 'updateCategory'])->middleware('auth:sanctum'); //Uppdaterar en kategori
Route::delete('/deletecategory/{id}', [CategoryController::class, 'deleteCategory'])->middleware('auth:sanctum');  //Tar bort en kategori

//Produkter-routes
Route::get('/getproducts', [ProductController::class, 'getProducts'])->middleware('auth:sanctum'); //Hämtar alla produkter
Route::get('/getproductbyid/{id}', [ProductController::class, 'getProductById'])->middleware('auth:sanctum'); //Hämtar enskild produkt
Route::get('/products/search/{name}', [ProductController::class, 'searchProduct'])->middleware('auth:sanctum'); //Söka efter produkt efter namn
Route::post('/addproduct', [ProductController::class, 'addProduct'])->middleware('auth:sanctum'); //Lägger till en produkt
Route::put('/updateproduct/{id}', [ProductController::class, 'updateProduct'])->middleware('auth:sanctum'); //Uppdaterar en produkt
Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');  //Tar bort en produkt

//Route för att registrera 
Route::post('/register', [AuthController::class, 'register']);
//Route för att logga in
Route::post('/login', [AuthController::class, 'login']);
//Route för att logga ut
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
