<?php

use App\Http\Controllers\GoogleOAuthController;
use App\Http\Controllers\TravelController;
use App\Models\Covid;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Covid/Covid', [
        'localData' => Covid::where([['stdDay', Covid::max('stdDay')], ['gubun', 'not like', '합계']])->orderByRaw('localOccCnt + overFlowCnt DESC')->get(),
        'totalData' => Covid::where('gubun', '합계')->orderByDesc('stdDay')->get(),
    ]);
})->name('covid');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/travel', [TravelController::class, 'index'])->name('travel.index');

Route::get('/travel/{id}', [TravelController::class, 'show'])->name('travel.show');

Route::get('auth/google', [GoogleOAuthController::class, 'redirectToGoogle'])->name('googleLogin');

Route::get('/google/callback', [GoogleOAuthController::class, 'handleGoogleCallback']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
});
