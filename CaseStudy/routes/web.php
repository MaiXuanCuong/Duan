<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/login', function(){
//     return view('admin.customers.login');
// });
// Route::get('/register', function(){
//     return view('admin.customers.register');
// })->name('register');

Route::get('/',[AdminController::class,'checkLogin'])->name('login');
Route::get('/register', function(){
    return view('admin.register');
})->name('register');

Route::post('/customer/register', [CustomerController::class,'register'])->name('customer.register');
Route::post('/customer/login', [CustomerController::class,'login'])->name('customer.login');

Route::post('/admin/register', [AdminController::class,'register'])->name('admin.register');

Route::post('/admin/login', [AdminController::class,'login'])->name('admin.login');
Route::get('/admin/login', [AdminController::class,'logout'])->name('admin.logout');


Route::prefix('/')->middleware(['auth', 'preventBackHistory'])->group(function(){
    Route::get('/home', [CategoriesController::class,'home'])->name('/');
    
    Route::prefix('categories')->group(function(){
    Route::get('/', [CategoriesController::class,'index'])->name('categories');
    Route::get('/add', [CategoriesController::class,'create'])->name('categories.add');
    
    Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
    
    Route::delete('/delete/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    
    Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
    
    Route::put('/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
});

Route::prefix('products')->group(function(){
    Route::get('/', [ProductsController::class,'index'])->name('products');
    Route::get('/add', [ProductsController::class,'create'])->name('products.add');
    
    Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
    
    Route::delete('/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

    Route::get('/deleted', [ProductsController::class, 'deleted'])->name('products.deleted'); 
    Route::delete('/delete/{id}', [ProductsController::class, 'delete'])->name('products.delete'); 
    Route::get('/recover/{id}', [ProductsController::class, 'recover'])->name('products.recover'); 
    
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    
    Route::put('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
});

Route::prefix('customers')->group(function(){
    Route::get('/', [CustomerController::class,'index'])->name('customers');
    Route::get('/add', [CustomerController::class,'create'])->name('customers.add');
    
    Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
    
    Route::delete('/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    
    Route::put('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
});

Route::prefix('orders')->group(function(){
    Route::get('/', [OrderController::class,'index'])->name('orders');
    Route::get('/add', [OrderController::class,'create'])->name('orders.add');
    
    Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/show/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});


});