<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
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


Route::get('/', [LandingpageController::class, 'index']);


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('SendOTP', [CommonController::class, 'SendOTP'])->name('SendOTP');
Route::post('otpResend', [CommonController::class, 'otpResend'])->name('otpResend');

Route::get('initiate-password-reset', [CommonController::class, 'passwordEmailForm'])->name('initiate-password-reset');

Route::get('dashboard', [AdminDashboardController::class, 'loginDashboard'])->name('dashboard');

Route::get('changes-password', [AdminDashboardController::class, 'ChangesPassword'])->name('changes-password');
Route::post('updatepassword', [AdminDashboardController::class, 'UpdatePassword'])->name('updatepassword');
Route::post('/verify-current-password', [AdminDashboardController::class, 'verifyCurrentPassword'])->name('verifyCurrentPassword');

Route::resource('category', CategoryController::class);
Route::post('AllCategoryTableData', [CategoryController::class, 'AllCategoryTableData'])->name('AllCategoryTableData');
Route::post('ChangeCategoryStatus', [CategoryController::class, 'ChangeCategoryStatus'])->name('ChangeCategoryStatus');
Route::post('checkCategoryName', [CategoryController::class, 'checkCategoryName'])->name('checkCategoryName');
// routes/web.php

// Route::resource('sub-category', SubCategoryController::class);
// Route::post('AllSubCategoryTableData', [SubCategoryController::class, 'AllSubCategoryTableData'])->name('AllSubCategoryTableData');
// Route::post('ChangeSubCategoryStatus', [SubCategoryController::class, 'ChangeSubCategoryStatus'])->name('ChangeSubCategoryStatus');
// Route::post('checkSubCategoryName', [SubCategoryController::class, 'checkSubCategoryName'])->name('checkSubCategoryName');

// Route::resource('blogs', BlogController::class);
// Route::post('AllBlogTableData', [BlogController::class, 'AllBlogTableData'])->name('AllBlogTableData');
// Route::post('ChangeBlogStatus', [BlogController::class, 'ChangeBlogStatus'])->name('ChangeBlogStatus');
// Route::get('/get-sub-categories/{catId}', [BlogController::class, 'getSubCategories']);

Route::resource('products', ProductsController::class);
Route::post('AllProductTableData', [ProductsController::class, 'AllProductTableData'])->name('AllProductTableData');
Route::post('ChangeProductStatus', [ProductsController::class, 'ChangeProductStatus'])->name('ChangeProductStatus');
require __DIR__.'/auth.php';
