<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Order\ViewOrdersController;
use App\Http\Controllers\Order\ManageOrdersController;
use App\Http\Controllers\Product\ViewProductsController;
use App\Http\Controllers\Order\ViewOrderDetailController;
use App\Http\Controllers\Customer\ViewCustomersController;
use App\Http\Controllers\Product\ManageProductsController;
use App\Http\Controllers\Customer\ManageCustomersController;
use App\Http\Controllers\Product\ViewProductDetailController;
use App\Http\Controllers\Customer\ViewCustomerDetailController;

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

Route::group(["prefix" => "unath"], function(){
    Route::get('/products', ViewProductsController::class)->name('products.index');
    Route::get('/products/{product}', ViewProductDetailController::class)->name('products.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    /* Manage product Routes */
    Route::resource('products', ManageProductsController::class)->only([
        'create', 'store', 'edit', 'update', 'destroy'
    ])->middleware(['permission:create-product|edit-product|delete-product']);

    /* Manage customers routes */
    Route::resource('customers', ManageCustomersController::class)->only([
        'create', 'store', 'edit', 'update', 'destroy'
    ])->middleware(['permission:create-customer|delete-customer|edit-customer']);

    Route::get('view/customers', ViewCustomersController::class)->middleware(['permission:view-customers'])->name('customers.index');
    Route::get('view/customers/{customer}', ViewCustomerDetailController::class)->middleware(['permission:view-customer-detail'])->name('customers.show');

    /* Manage order routes */
    Route::resource('orders', ManageOrdersController::class)->only([
        'create', 'store'
    ])->middleware(['permission:create-order']);

    Route::resource('orders', ManageOrdersController::class)->only([
        'edit', 'update', 'destroy'
    ])->middleware(['permission:delete-order|edit-order']);

    Route::get('view/orders', ViewOrdersController::class)->middleware(['permission:view-orders'])->name('orders.index');
    Route::get('view/orders/{order}', ViewOrderDetailController::class)->middleware(['permission:view-order-detail'])->name('orders.show');
});

require __DIR__.'/auth.php';