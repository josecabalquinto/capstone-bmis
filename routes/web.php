<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurokController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\WeightForAgeController;
use App\Http\Controllers\HeightForAgeController;
use App\Http\Controllers\WeightForHeightController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodDistributionController;
use App\Http\Controllers\VitaminDistributionController;
use App\Http\Controllers\VitaminController;

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


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/foods', [FoodController::class, 'foods'])->name('food.foods');
Route::post('/food', [FoodController::class, 'store'])->name('food.store');
Route::delete('/food/{food}', [FoodController::class, 'destroy'])->name('food.destroy');

Route::get('/distribute-food-create', [FoodDistributionController::class, 'create'])->name('distribute.create');
Route::get('/food-distributions', [FoodDistributionController::class, 'index'])->name('distribute.index');
Route::get('/food-distribution-details/{foodDistribution}', [FoodDistributionController::class, 'show'])->name('distribute.show');
Route::post('/distribute-food', [FoodDistributionController::class, 'store'])->name('distribute.store');

Route::get('/vitamins', [VitaminController::class, 'index'])->name('vitamin.index');
Route::post('/vitamin', [VitaminController::class, 'store'])->name('vitamin.store');
Route::delete('/vitamin/{vitamin}', [VitaminController::class, 'destroy'])->name('vitamin.destroy');

Route::get('/distribute-vitamin-create', [VitaminDistributionController::class, 'create'])->name('distributevit.create');
Route::get('/vitamin-distributions', [VitaminDistributionController::class, 'index'])->name('distributevit.index');
Route::get('/vitamin-distribution-details/{vitaminDistribution}', [VitaminDistributionController::class, 'show'])->name('distributevit.show');
Route::post('/distribute-vitamin', [VitaminDistributionController::class, 'store'])->name('distributevit.store');

Route::get('/puroks', [PurokController::class, 'index'])->name('purok.index');
Route::post('/purok', [PurokController::class, 'store'])->name('purok.store');
Route::delete('/purok/{purok}', [PurokController::class, 'destroy'])->name('puroks.destroy');

Route::get('/weight-for-age-boys', [WeightForAgeController::class, 'boys'])->name('wfa.boys');
Route::get('/weight-for-age-girls', [WeightForAgeController::class, 'girls'])->name('wfa.girls');
Route::post('/weight-for-age', [WeightForAgeController::class, 'store'])->name('wfa.store');
Route::delete('/weight-for-age/{weightForAge}', [WeightForAgeController::class, 'destroy'])->name('wfa.destroy');

Route::get('/height-for-age-boys', [HeightForAgeController::class, 'boys'])->name('hfa.boys');
Route::get('/height-for-age-girls', [HeightForAgeController::class, 'girls'])->name('hfa.girls');
Route::post('/height-for-age', [HeightForAgeController::class, 'store'])->name('hfa.store');
Route::delete('/height-for-age/{heightForAge}', [HeightForAgeController::class, 'destroy'])->name('hfa.destroy');

Route::get('/weight-for-height-boys', [WeightForHeightController::class, 'boys'])->name('wfh.boys');
Route::get('/weight-for-height-girls', [WeightForHeightController::class, 'girls'])->name('wfh.girls');
Route::post('/weight-for-height', [WeightForHeightController::class, 'store'])->name('wfh.store');
Route::delete('/weight-for-height/{weightForHeight}', [WeightForHeightController::class, 'destroy'])->name('wfh.destroy');

Route::get('/children-records', [ChildrenController::class, 'index'])->name('cr.index');
Route::get('/child-add-record', [ChildrenController::class, 'create'])->name('cr.create');
Route::post('/child-record', [ChildrenController::class, 'store'])->name('cr.store');
Route::get('/growth-track/{children}', [ChildrenController::class, 'show'])->name('cr.show');
Route::post('/growth-track/{children}', [ChildrenController::class, 'growth'])->name('cr.growth');

Route::middleware(['adminuser', 'auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user-create', [UserController::class, 'create'])->name('users.create');
    Route::post('/user', [UserController::class, 'store'])->name('users.store');
    Route::get('/user/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
