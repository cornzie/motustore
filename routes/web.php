<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Product\ViewProductsController;
use App\Http\Controllers\Product\ManageProductsController;
use App\Http\Controllers\Product\ViewProductDetailController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return redirect(route('products.index'));
})->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('products', ManageProductsController::class)->only([
    'create', 'store', 'edit', 'update', 'destroy'
])->middleware(['permission:create-product|edit-product|delete-product']);

Route::group(["prefix" => "unath"], function(){
    Route::get('/products', ViewProductsController::class)->name('products.index');
    Route::get('/products/{product}', ViewProductDetailController::class)->name('products.show');
});