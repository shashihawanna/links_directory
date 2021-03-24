<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();
Route::get('/', [LinkController::class, 'index'])->name('link.home');
Route::get('/viewLink', [LinkController::class, 'view'])->name('link.view');
Route::post('/addLink', [LinkController::class, 'add'])->name('link.add');
Route::post('/checkUrlExit', [LinkController::class, 'checkUrlExit'])->name('link.checkUrlExit');
