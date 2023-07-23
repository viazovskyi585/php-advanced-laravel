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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
});
