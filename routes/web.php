<?php

use App\Http\Controllers\LateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\StudentController;

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

// Route::get('/', function () {
//     return view('home');
// })->name('home');

// Route::get('/', function () {
//     return view('auth/login');
// })->name('login');

Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');

Route::middleware('IsLogin', 'IsAdmin')->group(function () {

    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/user/cari', [UserController::class, 'cari'])->name('cari');
    });
    Route::prefix('/student')->name('student.')->group(function () {
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/student/cari', [StudentController::class, 'cari'])->name('cari');
    });
    Route::prefix('/rombel')->name('rombel.')->group(function () {
        Route::get('/create', [RombelController::class, 'create'])->name('create');
        Route::post('/store', [RombelController::class, 'store'])->name('store');
        Route::get('/', [RombelController::class, 'index'])->name('index');
        Route::get('/{id}', [RombelController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RombelController::class, 'update'])->name('update');
        Route::delete('/{id}', [RombelController::class, 'destroy'])->name('destroy');
        Route::get('/rombel/cari', [RombelController::class, 'cari'])->name('cari');
    });
    Route::prefix('/rayon')->name('rayon.')->group(function () {
        Route::get('/create', [RayonController::class, 'create'])->name('create');
        // Route::post('/rayon', 'Namespace\RayonController@store')->name('rayon.store');
        Route::post('/store', [RayonController::class, 'store'])->name('store');
        Route::get('/', [RayonController::class, 'index'])->name('index');
        Route::get('/{id}', [RayonController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [RayonController::class, 'update'])->name('update');
        Route::delete('/{id}', [RayonController::class, 'destroy'])->name('destroy');
        Route::get('/rayon/cari', [RayonController::class, 'cari'])->name('cari');
    });
    Route::prefix('/late')->name('late.')->group(function () {
        Route::get('/create', [LateController::class, 'create'])->name('create');
        Route::post('/store', [LateController::class, 'store'])->name('store');
        Route::get('/', [LateController::class, 'index'])->name('index');
        Route::get('/{id}', [LateController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [LateController::class, 'update'])->name('update');
        Route::delete('/{id}', [LateController::class, 'destroy'])->name('destroy');
        Route::get('/download/{id}', [LateController::class, 'downloadPDF'])->name('downloadPDF');
        Route::get('/print/{id}', [LateController::class, 'showPrint'])->name('print');
        Route::get('/detail/{student_id}', [LateController::class, 'detail'])->name('detail');
        Route::get('/export/excel', [LateController::class,  'exportExcel'])->name('export.excel');
        Route::get('/late/cari', [LateController::class, 'cari'])->name('cari');
    });
});

Route::middleware('IsLogin', 'IsPs')->group(function () {

    Route::prefix('/student')->name('student.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
    });

    Route::prefix('/late')->name('late.')->group(function () {
        Route::get('/', [LateController::class, 'index'])->name('index');
        Route::get('/download/{id}', [LateController::class, 'downloadPDF'])->name('downloadPDF');
        Route::get('/print/{id}', [LateController::class, 'showPrint'])->name('print');
        Route::get('/detail/{student_id}', [LateController::class, 'detail'])->name('detail');
        Route::get('/export/excel', [LateController::class,  'exportExcel'])->name('export.excel');
    });
});
