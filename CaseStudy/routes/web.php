<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;



Route::get('/login', [UserController::class, 'checkLogin'])->name('login');
Route::post('/admin/login', [UserController::class, 'login'])->name('admin.login');

Route::prefix('/')->middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('/');
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('categories');
        Route::get('/add', [CategoriesController::class, 'create'])->name('categories.add');
        Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
        Route::get('/destroy/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::get('/garbageCan', [CategoriesController::class, 'garbageCan'])->name('categories.garbageCan');
        Route::get('/restore/{id}', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::get('/forceDelete/{id}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::put('/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::put('/search', [CategoriesController::class, 'search'])->name('categories.search');
    });
    
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductsController::class, 'index'])->name('products');
        Route::get('/add', [ProductsController::class, 'create'])->name('products.add');
        Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
        Route::get('/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
        Route::get('/garbageCan', [ProductsController::class, 'garbageCan'])->name('products.garbageCan');
        Route::get('/forceDelete/{id}', [ProductsController::class, 'forceDelete'])->name('products.forceDelete');
        Route::get('/restore/{id}', [ProductsController::class, 'restore'])->name('products.restore');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
        Route::put('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
        Route::get('/show/{id}', [ProductsController::class, 'show'])->name('products.show');
        Route::get('/OutOfStock', [ProductsController::class, 'productOutOfStock'])->name('products.OutOfStock');
    });

    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers');
        Route::get('/add', [CustomerController::class, 'create'])->name('customers.add');
        Route::post('/store', [CustomerController::class, 'store'])->name('customers.store');
        Route::delete('/delete/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders');
        Route::get('/add', [OrderController::class, 'create'])->name('orders.add');
        Route::post('/store', [OrderController::class, 'register'])->name('orders.register');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });
    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::get('/add', [UserController::class, 'create'])->name('users.add');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::put('/update/profile/{id}', [UserController::class, 'updateProfile'])->name('users.updateProfile');
        Route::put('/updatepassword', [UserController::class, 'changePassword'])->name('users.updatepassword');
        Route::put('/fogetpassword', [UserController::class, 'fogetPassword'])->name('users.fogetpassword');
        Route::get('/show/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/login', [UserController::class, 'logout'])->name('users.logout');
        Route::get('/garbageCan', [UserController::class, 'garbageCan'])->name('users.garbageCan');
        Route::get('/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
        Route::get('/forceDelete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');
        Route::get('user/GetDistricts', [UserController::class, 'GetDistricts'])->name('user.GetDistricts');
        Route::get('user/getWards', [UserController::class, 'getWards'])->name('user.getWards');

    });

    Route::prefix('role')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });
});

Route::prefix('xcshop')->group(function(){
    Route::get('/', [ShopController::class, 'index'])->name('shop.home');
    Route::get('/cart', [ShopController::class, 'cart'])->name('shop.cart');
    Route::get('/store/{id}',[ShopController::class,'store'])->name('shop.store');
    Route::patch('/update-cart', [ShopController::class, 'update'])->name('update.cart');
    Route::get('/removecart/{id}', [ShopController::class, 'remove'])->name('remove.cart');
    Route::get('/checkOuts', [ShopController::class, 'checkOuts'])->name('checkOuts');
    Route::post('/order', [ShopController::class, 'order'])->name('order');
    Route::get('/history', [ShopController::class, 'history'])->name('history');
    Route::get('customer/GetDistricts', [ShopController::class, 'GetDistricts'])->name('customer.GetDistricts');
    Route::get('customer/getWards', [ShopController::class, 'getWards'])->name('customer.getWards');
    Route::put('/update', [CustomerController::class, 'update'])->name('customers.update');
    
    Route::get('register', function(){
        return view('shop.customers.register');
    })->name('register');
    Route::get('login', function(){
        return view('shop.customers.login');
    })->name('shop.login');
    Route::get('product/{id}', [ShopController::class, 'view'])->name('shop.product');

    Route::get('logout', [CustomerController::class, 'logout'])->name('shop.logout');
    Route::post('/customer/register', [CustomerController::class, 'register'])->name('customer.register');
    Route::post('/customer/login', [CustomerController::class, 'login'])->name('customer.login');
    Route::post('/customer/changepassmail', [CustomerController::class, 'changepassmail'])->name('customer.changepassmail');
    Route::post('/user/changepassmail', [UserController::class, 'changepassmail'])->name('users.changepassmail');
    
});