<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\FrontedUserController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/cacheclear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    // dd("Done");
    return response()->json(["message" => "Cache clear", "status" => true]);
});

Route::get('/', [LandingpageController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('/user-logout', [FrontedUserController::class, 'FrontedUserLogout'])->name('user-logout');

Route::post('/add-wishlist', [WishlistController::class, 'addToWishlist'])->name('add-wishlist');
Route::any('/view-wishlist', [WishlistController::class, 'ViewWishlist'])->name('view-wishlist');
Route::post('/delete-wishlist', [WishlistController::class, 'remove'])->name('remove-wishlist');
Route::get('/wishlist-count', [WishlistController::class, 'CountWishlist'])->name('count-wishlist');

Route::get('/terms_condition', [LandingpageController::class, 'TermsCondition'])->name('terms_condition');
Route::get('/privacy_policy', [LandingpageController::class, 'PrivacyPolicy'])->name('privacy_policy');
Route::get('/product_detail/{id}', [LandingpageController::class, 'product_detail'])->name('product_detail');
Route::get('cat-product/{slug?}', [LandingpageController::class, 'CatWiseProduct'])->name('catwiseproduct');
Route::Post('user-login', [FrontedUserController::class, 'FrontedUserLogin'])->name('user-login');
Route::Post('user-register', [FrontedUserController::class, 'FrontedUserRegister'])->name('user-register');
Route::get('/checkout', [LandingpageController::class, 'checkout'])->name('checkout');
Route::post('/checkout/place-order', [LandingpageController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminDashboardController::class, 'login'])->name('admin.login');
    Route::get('dashboard', [AdminDashboardController::class, 'loginDashboard'])->name('dashboard');
    Route::resource('productss', ProductsController::class);
    Route::resource('category', CategoryController::class);

    Route::post('AllProductTableData', [ProductsController::class, 'AllProductTableData'])->name('AllProductTableData');
    Route::post('ChangeProductStatus', [ProductsController::class, 'ChangeProductStatus'])->name('ChangeProductStatus');

    Route::post('AllCategoryTableData', [CategoryController::class, 'AllCategoryTableData'])->name('AllCategoryTableData');
    Route::post('ChangeCategoryStatus', [CategoryController::class, 'ChangeCategoryStatus'])->name('ChangeCategoryStatus');
    Route::post('checkCategoryName', [CategoryController::class, 'checkCategoryName'])->name('checkCategoryName');
});

Route::post('SendOTP', [CommonController::class, 'SendOTP'])->name('SendOTP');
Route::post('otpResend', [CommonController::class, 'otpResend'])->name('otpResend');
Route::get('changes-password', [AdminDashboardController::class, 'ChangesPassword'])->name('changes-password');

Route::get('initiate-password-reset', [CommonController::class, 'passwordEmailForm'])->name('initiate-password-reset');



Route::post('updatepassword', [AdminDashboardController::class, 'UpdatePassword'])->name('updatepassword');
Route::post('/verify-current-password', [AdminDashboardController::class, 'verifyCurrentPassword'])->name('verifyCurrentPassword');


Route::Post('/get-grid-view', [ProductsController::class, 'getGridView'])->name('get-grid-view');
Route::Post('/get-list-view', [ProductsController::class, 'getListView'])->name('get-list-view');


Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

require __DIR__ . '/auth.php';

Route::get('product',[RazorpayController::class,'index']);
Route::post('razorpay-payment', [RazorpayController::class, 'store'])->name('razorpay.payment.store');
Route::get('/', [LandingpageController::class, 'index'])->name('home');

Route::post('/add-to-cart', [CommonController::class, 'addToCart'])->name('addToCart');
Route::post('/cart/delete', [CommonController::class, 'deletetocart'])->name('delete.to.cart');

