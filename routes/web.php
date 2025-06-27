<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheck;   
use App\Http\Middleware\AlreadyLoggedIn;
use App\Http\Controllers\CustomAuthController; 
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PaintersController;
use App\Http\Controllers\PhysicalOrderController;
use App\Http\Middleware\CheckPermission;

//main routes
Route::get('/',[CustomAuthController::class,'login'])->middleware(middleware: AlreadyLoggedIn::class)->name('login');
Route::get('/registration',[CustomAuthController::class,'registration'])->middleware(AlreadyLoggedIn::class);
Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomAuthController::class,'dashboard'])->middleware(AuthCheck::class)->name('dashboard');
Route::get('/logout',[CustomAuthController::class,'logout'])->name('logout');   



//forgot password routes
Route::view('/forgot-password','auth.forgot-password')->middleware(middleware: AlreadyLoggedIn::class)->name('password.request');
Route::post('/forgot-password',[PasswordResetController::class, 'passwordEmail'] )->middleware(middleware: AlreadyLoggedIn::class)->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class,'passwordReset'])->middleware(middleware: AlreadyLoggedIn::class)->name('password.reset');
Route::post('/reset-password',[PasswordResetController::class, 'passwordUpdate'])->middleware(middleware: AlreadyLoggedIn::class)->name('password.update');

//navigating to the various products
// Main categories (still separate if needed)
Route::get('/products/{category}', function ($category) {
    return view("products.$category");
})->name('products.category');

// Product detail
Route::get('/products/{category}/{type}', function ($category, $type) {
    return view("product_detail.$category", compact('category', 'type'));
})->name('products.detail');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [CustomAuthController::class, 'loginUser'])->name('admin.dashboard');
});

Route::get('/ConfirmOrder', [OrderController::class, 'confirmOrder'])->name('order');
Route::post('/save-phone', [OrderController::class, 'savePhone'])->name('order.savePhone');



Route::get('/OrderPlaced', function () {
    return view('OrderPlaced');
})->name('orderplaced');

Route::post('/order/{category}/{type}', [OrderController::class, 'store'])->name('order.store');

//Admin routes
 Route::resource('painters', PaintersController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('physicalOrders', PhysicalOrderController::class);
Route::get('/admin/Users/index', [AdminController::class, 'viewUsers'])->name('admin.Users.index');

Route::patch('/order/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
Route::patch('/user/{id}/role', [AdminController::class, 'updateRole'])->name('user.updateRole');




Route::get('/admin/orders/approved', [OrderController::class, 'showApprovedOrders'])->name('admin.orders.approved');

Route::get('/admin/orders/declined', [OrderController::class, 'showDeclinedOrders'])->name('admin.orders.declined');

Route::get('/admin/orders/pending', [OrderController::class, 'showPendingOrders'])->name('admin.orders.pending');

Route::get('/admin/orders/online', [AdminController::class, 'viewOnlineOrders'])->name('admin.orders.online')->name('admin.orders.filter');


Route::post('/submit-order', [OrderController::class, 'store'])->name('order.submit');

