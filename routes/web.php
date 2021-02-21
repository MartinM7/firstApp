<?php

use App\Http\Controllers\BlockListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileDownloadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    if(Auth::check()){
     return redirect()->to('/dashboard');
    }
    return view('auth.login');
});

Route::middleware(['auth:sanctum'])->get('/download/{media}', [FileDownloadController::class, 'download'])->name('file.download');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/blocklist', [BlockListController::class, 'index'])->name('blocklist');
