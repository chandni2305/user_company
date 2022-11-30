<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

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
    return view('welcome');
});

Route::resources(['users' => UserController::class,],['except' => ['destroy']]);

Route::get('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resources(['companies' => CompanyController::class,],['except' => ['destroy']]);

Route::get('/companies/destroy/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');
Route::get('/companies/add-users/{id}', [CompanyController::class, 'add_users'])->name('companies.add_users');
Route::post('/companies/store-users/{id}', [CompanyController::class, 'store_users'])->name('companies.store_users');

