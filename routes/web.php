<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockNeededController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthCheck;   
use App\Http\Middleware\AlreadyLoggedIn;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PaintersController;
use App\Http\Controllers\PhysicalOrderController;
use Illuminate\Support\Facades\Http;

// Public routes (no authentication required)
Route::get('/', [CustomAuthController::class, 'publicDashboard'])->name('publicDashboard');
Route::get('/login',[CustomAuthController::class,'login'])->middleware(AlreadyLoggedIn::class)->name('login');
Route::get('/registration',[CustomAuthController::class,'registration'])->middleware(AlreadyLoggedIn::class);
Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('login-user');

// Forgot password routes (public)
Route::view('/forgot-password','auth.forgot-password')->middleware(AlreadyLoggedIn::class)->name('password.request');
Route::post('/forgot-password',[PasswordResetController::class, 'passwordEmail'])->middleware(AlreadyLoggedIn::class)->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class,'passwordReset'])->middleware(AlreadyLoggedIn::class)->name('password.reset');
Route::post('/reset-password',[PasswordResetController::class, 'passwordUpdate'])->middleware(AlreadyLoggedIn::class)->name('password.update');

    // Product routes
    Route::get('/products/{category}', function ($category) {
        return view("products.$category");
    })->name('products.category');
    
    Route::get('/products/{category}/{type}', function ($category, $type) {
        return view("product_detail.$category", compact('category', 'type'));
    })->name('products.detail');

    
// Protected routes (require authentication)
Route::middleware([AuthCheck::class])->group(function () {
    Route::get('/dashboard',[CustomAuthController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[CustomAuthController::class,'logout'])->name('logout');
    Route::get('/mycart', [OrderController::class, 'myOrders'])->name('myOrders');
    Route::delete('/mycart/{order}', [OrderController::class, 'destroy'])->name('myOrders.destroy');
    

    
    // Order routes
    Route::get('/ConfirmOrder', [OrderController::class, 'confirmOrder'])->name('order');
    Route::post('/save-phone', [OrderController::class, 'savePhone'])->name('order.savePhone');
    Route::get('/OrderPlaced', function () {
        return view('OrderPlaced');
    })->name('orderplaced');
    Route::post('/order/{category}/{type}', [OrderController::class, 'store'])->name('order.store');
    Route::post('/submit-order', [OrderController::class, 'store'])->name('order.submit');
});

Route::middleware([AuthCheck::class . ':manufacturer,admin'])->group(function () {
    Route::prefix('manufacturer/materials')->group(function () {
        Route::get('/index', [MaterialController::class, 'index'])->name('materials.index');
        Route::get('/create', [MaterialController::class, 'create'])->name('materials.create');
        Route::post('/store', [MaterialController::class, 'store'])->name('materials.store');
        Route::get('/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
        Route::put('/{material}', [MaterialController::class, 'update'])->name('materials.update');
    });
});

// Admin routes (require authentication + admin role)
Route::middleware([AuthCheck::class. ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/settings', [AdminController::class, 'showPriceSetting'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updatePrice'])->name('admin.settings.update');
    Route::get('/admin/Users/index', [AdminController::class, 'viewUsers'])->name('admin.Users.index');
    
    Route::prefix('admin')->group(function () {
        Route::resource('painters', PaintersController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::resource('physicalOrders', PhysicalOrderController::class);
    });
    
    // Admin order management
    Route::patch('/order/{id}/status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::patch('/user/{id}/role', [AdminController::class, 'updateRole'])->name('user.updateRole');
    Route::patch('/user/{id}/status', [PhysicalOrderController::class, 'updateStatus'])->name('physicalOrder.updateStatus');
    
    Route::prefix('admin/orders')->group(function () {
        Route::get('/finished', [OrderController::class, 'showFinishedOrders'])->name('admin.orders.finished');
        Route::get('/approved', [OrderController::class, 'showApprovedOrders'])->name('admin.orders.approved');
        Route::get('/declined', [OrderController::class, 'showDeclinedOrders'])->name('admin.orders.declined');
        Route::get('/pending', [OrderController::class, 'showPendingOrders'])->name('admin.orders.pending');
        Route::get('/online', [AdminController::class, 'viewOnlineOrders'])->name('admin.orders.online');
    });

     
});

Route::get('/admin/invoice/{invoice}/preview', [OrderController::class, 'generateInvoicePDF'])
    ->name('invoice.preview');

Route::get('/admin/invoice/statement', [OrderController::class, 'generateInvoiceStatementPDF'])
    ->name('invoices.statement');

// Manufacturer routes (require authentication + manufacturer role)
Route::middleware([AuthCheck::class. ':manufacturer'])->group(function () {
    Route::prefix('manufacturer')->group(function (): void {
        Route::get('orders/pending', [ManufacturerController::class, 'pendingOrders'])->name('manufacturer.orders.pending');
        Route::get('stockNeeded', [ManufacturerController::class, 'stockNeeded'])->name('manufacturer.stockNeeded');
        Route::put('/orders/{order}/complete', [ManufacturerController::class, 'markAsCompleted'])->name('manufacturer.orders.markCompleted');
        Route::get('orders/{order}/suggest-materials', [ManufacturerController::class, 'suggestMaterials'])->name('manufacturer.suggest.materials');
        

        // Stock needed management
        Route::prefix('orders/{order}/stockNeeded')->group(function () {
            Route::get('/', [StockNeededController::class, 'index'])->name('stockNeeded.index');
            Route::get('/create', [StockNeededController::class, 'create'])->name('stockNeeded.create');
            Route::post('/store', [StockNeededController::class, 'store'])->name('stockNeeded.store');
            Route::get('/{id}/edit', [StockNeededController::class, 'edit'])->name('stockNeeded.edit');
            Route::put('/{id}/update', [StockNeededController::class, 'update'])->name('stockNeeded.update');
            Route::delete('/{id}', [StockNeededController::class, 'destroy'])->name('stockNeeded.destroy');
        });
    });
});

// Gemini routes (may need authentication depending on your requirements)
Route::middleware([AuthCheck::class. ':manufacturer'])->group(function () {
    Route::get('/orders/{id}/formula', [OrderController::class, 'showFormula']);
});


Route::get('/mpesa', [MpesaController::class, 'index'])->name('mpesa.index');
Route::get('/mpesa/token', [MpesaController::class, 'token'])->name('mpesa.token');
Route::post('/mpesa/stkpush', [MpesaController::class, 'STKpush'])->name('mpesa.stkpush');
Route::get('/mpesa/callback', [MpesaController::class, 'callback'])->name('mpesa.callback');
Route::get('/mpesa/session-data', [MpesaController::class, 'getSessionData'])->name('mpesa.session-data');



