<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\TransactionController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [App\Http\Controllers\DetailController::class, 'add'])->name('detail-add');



Route::post('/checkout/callback', [App\Http\Controllers\CheckoutController::class, 'callback'])->name('midtrans-callback');
Route::post('/checkout/finish', [App\Http\Controllers\CheckoutController::class, 'finish'])->name('midtrans-finish');
Route::post('/checkout/unfinish', [App\Http\Controllers\CheckoutController::class, 'unfinish'])->name('midtrans-finish');
Route::post('/checkout/error', [App\Http\Controllers\CheckoutController::class, 'error'])->name('error');


Route::get('/success', [App\Http\Controllers\CartController::class, 'success'])->name('success');


Route::get('/register/success', [App\Http\Controllers\Auth\RegisterController::class, 'success'])->name('register-success');



Route::group(['middleware'=>['auth']],function(){
        Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
        Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'delete'])->name('cart-delete');
        Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout');


        Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])
            ->name('dashboard-product');
        Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])
            ->name('dashboard-product-create');
        Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'store'])
            ->name('dashboard-product-store');
        Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])
            ->name('dashboard-product-details');
        Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])
            ->name('dashboard-product-update');

        Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])
            ->name('dashboard-product-gallery-upload');
        Route::get('/dashboard/products/gallery/delete/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])
            ->name('dashboard-product-gallery-delete');

        Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'index'])
            ->name('dashboard-transactions');
        Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'details'])
            ->name('dashboard-transactions-details');
        Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'update'])
            ->name('dashboard-transactions-update');
        //

        Route::get('/dashboard/settings', [App\Http\Controllers\DashboardSettingController::class, 'store'])
            ->name('dashboard-settings-store');
        Route::get('/dashboard/account', [App\Http\Controllers\DashboardSettingController::class, 'account'])
            ->name('dashboard-settings-account');
        Route::post('/dashboard/account/{redirect}', [App\Http\Controllers\DashboardSettingController::class, 'update'])
            ->name('dashboard-settings-redirect');

});

    //>middleware(['auth','admin'])
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('category',CategoryController::class);
        Route::resource('user',UserController::class);
        Route::resource('product',ProductController::class);
        Route::resource('product-gallery',ProductGalleryController::class);
        Route::resource('transaction',TransactionController::class);
        //percobaan

        //Route::get('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'index'])
        //   ->name('dashboard-product');
        //Route::get('/dashboard/products/create', [App\Http\Controllers\DashboardProductController::class, 'create'])
        //    ->name('dashboard-product-create');
        //Route::post('/dashboard/products', [App\Http\Controllers\DashboardProductController::class, 'store'])
         //   ->name('dashboard-product-store');
        //Route::get('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'details'])
         //   ->name('dashboard-product-details');
        //Route::post('/dashboard/products/{id}', [App\Http\Controllers\DashboardProductController::class, 'update'])
         //   ->name('dashboard-product-update');
        //Route::post('/dashboard/products/gallery/upload', [App\Http\Controllers\DashboardProductController::class, 'uploadGallery'])
          //  ->name('dashboard-product-gallery-upload');
        //Route::get('/dashboard/products/gallery/delete/{id}', [App\Http\Controllers\DashboardProductController::class, 'deleteGallery'])
          //  ->name('dashboard-product-gallery-delete');



       Route::get('/dashboard/transactions', [App\Http\Controllers\DashboardTransactionController::class, 'indexadmin'])
           ->name('dashboard-transactions-admin');
        Route::get('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'detailsadmin'])
           ->name('dashboard-transactions-details-admin');
        Route::post('/dashboard/transactions/{id}', [App\Http\Controllers\DashboardTransactionController::class, 'updateadmin'])
            ->name('dashboard-transactions-update-admin');
    });

Auth::routes();

