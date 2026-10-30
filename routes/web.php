<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', HomeController::class);
Route::resource('about-us', AboutUsController::class);
Route::resource('contact-us', ContactUsController::class);
Route::resource('cart', CartController::class);
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::get('/order-confirm', [CartController::class, 'orderConfirm'])->name('cart.order.confirm');
Route::resource('dashboard', DashboardController::class)->middleware(['auth']);
Route::resource('category', CategoryController::class)->middleware(['auth']);
Route::resource('product', ProductController::class)->middleware(['auth']);
Route::post('/product-variation-update/{id}', [ProductController::class, 'productVariationUpdate'])->middleware(['auth']);
Route::post('/product-flavour-update/{id}', [ProductController::class, 'productFlavourUpdate'])->middleware(['auth']);
Route::post('/product-side-update/{id}', [ProductController::class, 'productSideUpdate'])->middleware(['auth']);
Route::post('/product-drink-update/{id}', [ProductController::class, 'productDrinkUpdate'])->middleware(['auth']);
Route::post('/product-sauce-update/{id}', [ProductController::class, 'productSauceUpdate'])->middleware(['auth']);
Route::post('/product-removable-update/{id}', [ProductController::class, 'productRemovableUpdate'])->middleware(['auth']);
Route::resource('order', OrderController::class)->middleware(['auth']);
Route::get('/order-list/{status}', [OrderController::class, 'orderList'])->middleware(['auth']);
Route::get('/update-order-status/{id}/{status}', [OrderController::class, 'updateOrderStatus'])->middleware(['auth']);
Route::get('/checkNewOrder', [OrderController::class, 'checkNewOrder'])->middleware(['auth']);


Route::get('/update-product-cart/{id}/{quantity}', [CartController::class, 'updateProductCart']);
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('payment', [CartController::class, 'paymentProcess'])->name('payment');
Route::get('/success', [CartController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [CartController::class, 'cancel'])->name('checkout.cancel');
Route::post('/webhook', [CartController::class, 'webhook'])->name('checkout.webhook');
Route::get('/customerlogin', [CustomerController::class, 'customerLogin'])->name('customer.login');
Route::get('/customerLogout', [CustomerController::class, 'customerLogout'])->name('customer.logout');
Route::post('/frontlogin', [CustomerController::class, 'login'])->name('frontlogin');
Route::get('/customer/login', [CustomerController::class, 'customerBasicLogin'])->name('customer.login.basic');
Route::post('/basicLogin', [CustomerController::class, 'basicLogin'])->name('basicLogin');
Route::get('/customer/dashboard', [CustomerController::class, 'customerDashboard'])->name('customer.dashboard')->middleware(['customer']);
Route::get('customer/order-list/{status}', [CustomerController::class, 'orderList'])->middleware(['customer']);
Route::get('customer/order-details/{id}', [CustomerController::class, 'customerOrderDetails'])->middleware(['customer']);

Route::get('/registration', [CustomerController::class, 'customerRegistration'])->name('registration');
Route::post('storeCurtomer', [CustomerController::class, 'storeCustomer'])->name('storeCurtomer');



Route::get('payment', [PayPalController::class,'handlePayment'])->name('payment');
Route::get('payment/cancel', [PayPalController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class,'success'])->name('payment.success');


// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
