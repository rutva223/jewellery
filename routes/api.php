<?php

use App\Http\Controllers\Api\BlogApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('bloglist',[BlogApiController::class, 'BlogList']);
Route::post('topcategory',[BlogApiController::class, 'TopCategoryList']);
Route::post('blogdetail',[BlogApiController::class, 'BlogDetail']);
Route::post('category',[BlogApiController::class, 'Category']);

