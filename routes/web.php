<?php

use App\Http\Controllers\MainController;
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




Route::middleware(['authuser'])->prefix('/')->group(function () {
    Route::get('/', [MainController::class, 'indexpage'])->name('indexpage');
    Route::get('/about', [MainController::class, 'aboutpage'])->name('aboutpage');
    Route::get('/contact', [MainController::class, 'contactpage'])->name('contactpage');
    Route::get('/resorts', [MainController::class, 'resortspage'])->name('resortspage');
    Route::get('/login', [MainController::class, 'loginpage'])->name('loginpage');
    
});

Route::middleware(['client'])->group(function () {
    Route::get('/uabout', [MainController::class, 'uabout'])->name('uabout');
    Route::get('/ucontact', [MainController::class, 'ucontact'])->name('ucontact');
    Route::get('/uindex', [MainController::class, 'uindex'])->name('uindex');
    Route::get('/uprofile', [MainController::class, 'uprofile'])->name('uprofile');
    Route::get('/uresorts', [MainController::class, 'uresorts'])->name('uresorts');
});

Route::middleware(['incharge'])->prefix('in-charge')->group(function () {
    Route::get('/', [MainController::class, 'inchargeIndex'])->name('inchargeIndex');
    Route::get('/profile', [MainController::class, 'inchargeProfile'])->name('inchargeProfile');
    Route::get('/reserved', [MainController::class, 'inchargeReserved'])->name('inchargeReserved');
    Route::get('/resorts', [MainController::class, 'inchargeResorts'])->name('inchargeResorts');
    Route::get('/rooms', [MainController::class, 'inchargeRooms'])->name('inchargeRooms');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/', [MainController::class, 'adminIndex'])->name('adminIndex');
    Route::get('/profile', [MainController::class, 'adminProfile'])->name('adminProfile');
    Route::get('/reserved', [MainController::class, 'adminReserved'])->name('adminReserved');
    Route::get('/resorts', [MainController::class, 'adminResorts'])->name('adminResorts');
    Route::get('/rooms', [MainController::class, 'adminRooms'])->name('adminRooms');
});

Route::get('/view-cookie', function () {
    // $cookies = $_COOKIE['samplecookie'];
    $cookies = request()->cookies->all();
    // $cookies = request()->cookie('samplecookie');
    // $cookies = request()->session()->all();
    return response()->json(['cookies' => $cookies]);
});
// Route::post('/set-cookie', function () {

//     $cookieName = 'samplecookie';
//     $cookieValue = 'test123444122';
//     $minutes = 60;
//     $path = '/';
//     $cookie = cookie($cookieName, $cookieValue, $minutes, $path);

//     return response()->json(['message' => 'Successfully created'])->withCookie($cookie);
// });

