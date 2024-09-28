<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriberController;
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



Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', [AdminDashboardController::class, 'loginDashboard'])->name('dashboard');
    Route::resource('productss', ProductsController::class);
    Route::resource('category', CategoryController::class);

    Route::post('AllProductTableData', [ProductsController::class, 'AllProductTableData'])->name('AllProductTableData');
    Route::post('ChangeProductStatus', [ProductsController::class, 'ChangeProductStatus'])->name('ChangeProductStatus');

    Route::post('AllCategoryTableData', [CategoryController::class, 'AllCategoryTableData'])->name('AllCategoryTableData');
    Route::post('ChangeCategoryStatus', [CategoryController::class, 'ChangeCategoryStatus'])->name('ChangeCategoryStatus');
    Route::post('checkCategoryName', [CategoryController::class, 'checkCategoryName'])->name('checkCategoryName');
});
Route::get('/terms_condition', [LandingpageController::class, 'TermsCondition'])->name('terms_condition');
Route::get('/privacy_policy', [LandingpageController::class, 'PrivacyPolicy'])->name('privacy_policy');
Route::get('/product_detail/{id}', [LandingpageController::class, 'product_detail'])->name('product_detail');
Route::get('/{slug}', [LandingpageController::class, 'CatWiseProduct'])->name('catwiseproduct');

Route::get('/admin/login', [AdminDashboardController::class, 'login'])->name('admin.login');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('SendOTP', [CommonController::class, 'SendOTP'])->name('SendOTP');
Route::post('otpResend', [CommonController::class, 'otpResend'])->name('otpResend');
Route::get('changes-password', [AdminDashboardController::class, 'ChangesPassword'])->name('changes-password');

Route::get('initiate-password-reset', [CommonController::class, 'passwordEmailForm'])->name('initiate-password-reset');



Route::post('updatepassword', [AdminDashboardController::class, 'UpdatePassword'])->name('updatepassword');
Route::post('/verify-current-password', [AdminDashboardController::class, 'verifyCurrentPassword'])->name('verifyCurrentPassword');


Route::Post('/get-grid-view', [ProductsController::class, 'getGridView'])->name('get-grid-view');
Route::Post('/get-list-view', [ProductsController::class, 'getListView'])->name('get-list-view');



Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');

require __DIR__ . '/auth.php';

Route::get('product',[RazorpayController::class,'index']);
Route::post('razorpay-payment', [RazorpayController::class, 'store'])->name('razorpay.payment.store');
Route::get('/', [LandingpageController::class, 'index'])->name('home');

Route::post('/add-to-cart', [CommonController::class, 'addToCart']);
Route::post('/cart/delete', [CommonController::class, 'deletetocart'])->name('delete.to.cart');
