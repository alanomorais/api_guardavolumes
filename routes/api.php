<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PacienteController;
use App\Http\Controllers\Api\ArmarioController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\MvArmarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->namespace('api')->group(function(){

    Route::post('login', [AuthController::class, 'login'])->name('login');
    //Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    //Rota utilizada em testes para inserir o primeiro usuário
    //Route::post('usuarios/',[UserController::class,'store'])->name('store');



    Route::group(['middleware' => ['apiJwt']], function (){
        Route::prefix('/dashboard')->name('dashboard.')->group(function(){
            
            Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        });// /api/v1/usuarios/metodo
        Route::prefix('/usuarios')->name('usuarios.')->group(function(){

            Route::post('logout', [AuthController::class, 'logout']);

            Route::post('/',[UserController::class,'store'])->name('store');

            Route::get('/',[UserController::class,'index'])->name('index');


            Route::put('/{id}',[UserController::class,'update'])->name('update');

            Route::get('/{id}',[UserController::class,'show'])->name('show');

            Route::delete('/{id}',[UserController::class,'destroy'])->name('destroy');

            Route::get('/{id}/pacientes',[UserController::class,'listPacientes'])->name('listPacientes');


        });// /api/v1/usuarios/metodo

        Route::prefix('/pacientes')->name('pacientes.')->group(function(){


            Route::get('/',[PacienteController::class,'index'])->name('index');

            Route::post('/',[PacienteController::class,'store'])->name('store');

            Route::put('/{id}',[PacienteController::class,'update'])->name('update');

            Route::get('/{id}',[PacienteController::class,'show'])->name('show');

            Route::delete('/{id}',[PacienteController::class,'destroy'])->name('destroy');

        });// /api/v1/usuarios/metodo

        Route::prefix('/armarios')->name('pacientes.')->group(function(){


            Route::get('/',[ArmarioController::class,'index'])->name('index');

            Route::post('/',[ArmarioController::class,'store'])->name('store');

            Route::put('/{id}',[ArmarioController::class,'update'])->name('update');

            Route::get('/{id}',[ArmarioController::class,'show'])->name('show');

            Route::delete('/{id}',[ArmarioController::class,'destroy'])->name('destroy');

        });// /api/v1/armarios/metodo

        Route::prefix('/mvarmario')->name('pacientes.')->group(function(){


        Route::get('/',[MvArmarioController::class,'index'])->name('index');

        Route::post('/',[MvArmarioController::class,'store'])->name('store');

        Route::put('/{id}',[MvArmarioController::class,'update'])->name('update');

        Route::get('/{id}',[MvArmarioController::class,'show'])->name('show');

        Route::delete('/{id}',[MvArmarioController::class,'destroy'])->name('destroy');

        });// /api/v1/mvarmario/metodo
    });
});
