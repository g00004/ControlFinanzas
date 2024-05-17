<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanzasController; 
use App\Http\Controllers\HomeController; 

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
    if(auth()->check()){
        return redirect()->route('home');
    }else{
        return redirect()->route('login');
    }
});

Auth::routes();

Route::group(['middleware' => ['auth'] ], function(){
    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
  
    // Modulo Entradas
    Route::get('entrada', [FinanzasController::class, 'craer_entradas']);
    Route::post('guardar_entrada', [FinanzasController::class, 'guardar_entrada']);
    Route::get('ver-entradas', [FinanzasController::class, 'all_entradas']);
    Route::post('entrada_destroy', [FinanzasController::class, 'entrada_destroy']);
    
    // Modulo Salidas
    Route::get('salida', [FinanzasController::class, 'craer_salidas']);
    Route::post('guardar_salida', [FinanzasController::class, 'guardar_salida']);
    Route::get('ver-salidas', [FinanzasController::class, 'all_salidas']);
    Route::post('salida_destroy', [FinanzasController::class, 'salida_destroy']);

  
    Route::get('balance', [FinanzasController::class, 'balance']);

});