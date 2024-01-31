<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObjectoftradeController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
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


    Route::get('/index', function () {
        return view('index');
    });

    //Route::get('/admin', \App\Http\Controllers\IndexController::class);

    Route::resource('objectoftrades', ObjectoftradeController::class)
        ->only(['create', 'edit', 'update', 'delete'])
        ->middleware(['auth', 'verified']);


    Route::get('/', [ObjectoftradeController::class, 'index'])->name('objectoftrade.index');;
    Route::get('/show', [ObjectoftradeController::class, 'show'])->name('objectoftrade.show');
    Route::get('/create', [ObjectoftradeController::class, 'create'])->name('objectoftrade.create');
    Route::post('/store', [ObjectoftradeController::class, 'store'])->name('objectoftrade.store');
    Route::get('/edit', [ObjectoftradeController::class, 'edit'])->name('objectoftrade.edit');
    Route::put('/{id}', [ObjectoftradeController::class, 'update'])->name('objectoftrade.update');
    Route::delete('/{id}', [ObjectoftradeController::class, 'delete'])->name('objectoftrade.delete');
    Route::put('/search', [ObjectoftradeController::class, 'search'])->name('objectoftrade.search');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('order.create');
    Route::delete('/order/delete', [OrderController::class, 'delete'])->name('order.delete');
    Route::get('/order/buying', [OrderController::class, 'buying'])->name('order.buying');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'index'])->name('category.create');
    Route::get('/categories/edit', [CategoryController::class, 'index'])->name('category.edit');

//    Route::get('/dashboard', function () {
//        return view('objectoftrade.index',[
//            'myobjects'=>\App\Models\objectoftrade::all(),
//            'myorders'=>false,
//            'orders'=> Order::all()->where('userid',Auth::id() && 'status', false)->count(),
//            'role'=>auth()->user()->role == 1?true:false]);
//    })->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('/dashboard');})->middleware(['auth', 'verified']);

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    require __DIR__.'/auth.php';
