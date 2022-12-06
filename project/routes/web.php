<?php

use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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
    return view('welcome');
});
Route::get('show_member',[MemberController::class,'index']);
Route::post('show_member',[MemberController::class,'store']);
Route::get('fetch',[MemberController::class,'fetch']);

Route::get('edit_data/{member}',[MemberController::class,'edit']);
Route::put('update_data/{member}',[MemberController::class,'update']);
Route::delete('delete/{member}',[MemberController::class,'destroy']);