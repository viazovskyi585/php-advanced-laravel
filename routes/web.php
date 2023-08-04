<?php

use App\Enums\Roles;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'index'])->name('categories.index');
Route::get('/categories/{slugs}', [\App\Http\Controllers\CategoriesController::class, 'show'])->name('categories.show')->where('slugs', '.*');
Route::get('product/{product:slug}', [\App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/orders', [\App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');

    Route::get('/checkout', \App\Http\Controllers\CheckoutController::class)->name('checkout');

    Route::get('/orders/{orderId}/success', \App\Http\Controllers\Payment\PaymentSuccessController::class)->name('orders.success');
});

require __DIR__ . '/auth.php';

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['role:' . implode('|', [Roles::ADMIN->value, Roles::MANAGER->value, Roles::EDITOR->value])])
    ->group(function () {
        Route::get('dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)->except(['show']);
        Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)->except(['show']);
    });

Route::name('ajax.')->middleware('auth')->prefix('ajax')->group(function () {
    Route::group(['role:' . implode('|', [Roles::ADMIN->value, Roles::MANAGER->value, Roles::EDITOR->value])], function () {
        Route::delete('delete-image/{image}', \App\Http\Controllers\Ajax\RemoveImageController::class)->name('image.delete');
    });

    Route::prefix('paypal')->name('paypal.')->group(function () {
        Route::post('order/create', [\App\Http\Controllers\Payment\PaypalController::class, 'create'])->name('order.create');
        Route::post('order/{orderId}/capture', [\App\Http\Controllers\Payment\PaypalController::class, 'capture'])->name('order.capture');
    });
});

Route::name('cart.')->prefix('cart')->group(function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
    Route::post('{product}', [\App\Http\Controllers\CartController::class, 'add'])->name('add');
    Route::delete('/', [\App\Http\Controllers\CartController::class, 'remove'])->name('remove');
    Route::post('{product}/count', [\App\Http\Controllers\CartController::class, 'updateCount'])->name('count');
});
