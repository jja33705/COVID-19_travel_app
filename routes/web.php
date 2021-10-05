<?php

use App\Models\Covid;
use Illuminate\Support\Facades\DB;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'localData' => Covid::where('stdDay', Covid::max('stdDay'))->where('gubun', 'not like', 'Total')->get(),
        'totalData' => Covid::where('gubun', 'Total')->orderByDesc('stdDay')->get(),
        // 'localData' => DB::table('covids')->selectRaw('gubun', 'localOccCnt + overFlowCnt as newPatiant')
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/myPage', function () {
        return Inertia::render('MyPage');
    });
});