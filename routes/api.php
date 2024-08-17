<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;

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

Route::post('getUser', [LoginController::class, 'login']);
Route::post('addUser', [LoginController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::post('addreserve', [MainController::class, 'addreserve']);
    Route::post('addresort', [MainController::class, 'addResort']);
    Route::post('addroom', [MainController::class, 'addRoom']);

    Route::post('deletereserve', [MainController::class, 'deleteReservation']);
    Route::post('deleteresort', [MainController::class, 'deleteResort']);
    Route::post('deleteroom', [MainController::class, 'deleteRoom']);
    Route::post('deleteuser', [MainController::class, 'deleteUser']);

    Route::post('editreserve', [MainController::class, 'updateReservation']);
    Route::post('editresort', [MainController::class, 'updateResort']);
    Route::post('editroom', [MainController::class, 'updateRoom']);
    Route::post('edituser', [MainController::class, 'updateUser']);

    
    Route::get('grabreserve', [MainController::class, 'getReserves']);
    Route::match(['get', 'post'], 'grabresorts', [MainController::class, 'getResorts']);
    Route::match(['get', 'post'], 'grabrooms', [MainController::class, 'getRooms']);
    Route::match(['get', 'post'], 'grabusers', [MainController::class, 'getUsers']);
    Route::match(['get', 'post'], 'reserve', [MainController::class, 'reserve']);
    Route::get('customer/displayresorts', [MainController::class, 'cgetResorts']);
});

Route::get('viewheaders', function () {
    return request()->headers->all();
})->middleware('auth:sanctum');


Route::get('viewtoken', function () {
    $accountId = request()->cookie('account_id');
    
    if (!$accountId) {
        return response()->json(['error' => 'Account ID cookie not found'], 400);
    }

    $user = User::where('account_id', $accountId)->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $token = $user->tokens()->where('name', 'API-TOKEN')->first();

    if (!$token) {
        return response()->json(['error' => 'API token not found'], 404);
    }

    return $token->plainTextToken;
});

Route::match(['get', 'post'], 'getresortwithroom', [MainController::class, 'viewResorts']);