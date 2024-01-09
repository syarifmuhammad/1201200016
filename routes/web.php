<?php

use App\Http\Controllers\AksesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/aksesApiGetEmployee', [AksesController::class, 'aksesApiGetEmployee']);
Route::get('/aksesApiGetEmployeeById/{id}', [AksesController::class, 'aksesApiGetEmployeeById']);
Route::get('/aksesApiInsertEmployee', [AksesController::class, 'aksesApiInsertEmployee']);
Route::get('/aksesApiUpdateEmployee/{id}', [AksesController::class, 'aksesApiUpdateEmployee']);
Route::get('/aksesApiDeleteEmployee/{id}', [AksesController::class, 'aksesApiDeleteEmployee']);
