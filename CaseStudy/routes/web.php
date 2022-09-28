<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
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
    Route::get('/destroy/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
    Route::get('/garbageCan', [CategoriesController::class, 'garbageCan'])->name('categories.garbageCan'); 
    Route::get('/restore/{id}', [CategoriesController::class, 'restore'])->name('categories.restore'); 
    Route::get('/forceDelete/{id}', [CategoriesController::class, 'forceDelete'])->name('categories.forceDelete'); 
    Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
});

Route::prefix('products')->group(function(){
    Route::get('/', [ProductsController::class,'index'])->name('products');
    Route::get('/add', [ProductsController::class,'create'])->name('products.add');
    Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
    Route::delete('/destroy/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
    Route::get('/garbageCan', [ProductsController::class, 'garbageCan'])->name('products.garbageCan'); 
    Route::delete('/forceDelete/{id}', [ProductsController::class, 'forceDelete'])->name('products.forceDelete'); 
    Route::get('/restore/{id}', [ProductsController::class, 'restore'])->name('products.restore'); 
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('/update/{id}', [ProductsController::class, 'update'])->name('products.update');
    Route::get('/show/{id}', [ProductsController::class, 'show'])->name('products.show');
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
    Route::post('/store', [OrderController::class, 'register'])->name('orders.register');
    Route::get('/show/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});
Route::prefix('users')->group(function(){
    Route::get('/', [AdminController::class,'index'])->name('users');
    Route::get('/add', [AdminController::class,'create'])->name('users.add');
    Route::post('/store', [AdminController::class, 'store'])->name('users.store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('users.update');
    Route::get('/show/{id}', [AdminController::class, 'show'])->name('users.show');
    Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

  Route::prefix('role')->group(function(){
        Route::get('/', [RoleController::class, 'index'])->name('role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });

});
// Route::get("thanh_cong", function(){
//     $language = session()->get('language');
//     App::setlocale($language);// thay đổi ngôn ngữ
//     echo __('messages.msg_ok',['name' => '123']);
//     echo '<br>';
//     echo __('MSG_OK');
//     echo '<br>';
//     echo __('MSG_ERROR');
// });
// Route::get('change_lang/{language}', function ($language) {
//     session(['language' => $language]);
//     return redirect("thanh_cong");
// });