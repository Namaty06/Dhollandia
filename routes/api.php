<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeVehiculeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\Models\User;
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
    $user = User::whereId($request->user()->id)->with('role.permission')->firstOrFail();
    return $user;
});

Route::post('/login', [AuthController::class, 'auth']);

Route::middleware('auth:sanctum')->group(function() {

Route::get('/Intervention/{year}', [ApiController::class, 'intervention']);
Route::get('/All', [ApiController::class, 'list']);

// Route::get('/Intervention/{year}', [InterventionController::class, 'index']);
Route::get('/Examen', [ApiController::class, 'examens']);
Route::put('/Rapport/{id}', [ApiController::class, 'updateContrat']);
Route::put('Intervention/Cloturer/{id}', [ApiController::class, 'updateRec']);
Route::put('token/update', [ApiController::class, 'updatetoken']);

Route::post('/logout', [AuthController::class, 'logout']);

});





