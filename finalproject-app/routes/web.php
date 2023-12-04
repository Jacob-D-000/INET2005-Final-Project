<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// category routes
// Serve the index page for categories
Route::get("/categories", [CategoryController::class, "index"])->name("categories.index");

// Serve the create form page for categories
Route::get("/categories/create", [CategoryController::class, "create"])->name("categories.create");

// Route to the store script for categories
Route::post("/categories", [CategoryController::class, "store"])->name("categories.store");

// Serve the edit page for categories
Route::get("/categories/{id}/edit", [CategoryController::class, "edit"])->name("categories.edit");

// Route to the update script for categories
Route::patch("/categories/{id}", [CategoryController::class, "update"])->name("categories.update");


// items routes
// Serve the index page for items
Route::get("/items", [ItemController::class, "index"])->name("items.index");

// Serve the create form page for items
Route::get("/items/create", [ItemController::class, "create"])->name("items.create");

// Route to the store script for items
Route::post("/items", [ItemController::class, "store"])->name("items.store");

// Serve the edit page for an items
Route::get("/items/{id}/edit", [ItemController::class, "edit"])->name("items.edit");

// Route to the update script for and item
Route::patch('/items/{id}', [ItemController::class, 'update'])->name('items.update');

// Route to delete script for an item
Route::delete('/items/{id}', [ItemController::class, "destroy"])->name("items.destroy");
