<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
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
    return view('index');
});
Route::get('/Login',function(){
    return view('login');
});
Route::post('/UserLogin',[UserController::class,'Login']);
Route::post('/CreateCustomer',[CustomerController::class,'CreateCustomer']);
Route::get('/AddCustomer',function () {
    return view('add-customer');
});
Route::get('/Users',function(){
    return view('userlist');
});
Route::get('/UserProfile',function(){
    return view('user-profile');
});
Route::post('/UpdateProfile',[UserController::class,'UpdateProfile']);
Route::get('/CustomersList', function (){
    return view('/customerlist');
});
Route::get('/EditUser/{id}',function($id){
    return view('edituser',['id'=>$id]);
});
Route::get('/AddUser',function(){
    return view('adduser');
});
Route::post('/CreateUser',[UserController::class,'CreateUser']);
Route::get('/Logout',[UserController::class,'LogoutUser']);
Route::post('/UpdateUser',[UserController::class,'UpdateUser']);
Route::get('/Permissions',function(){
    return view('permissions');
});
Route::post('/permission',function(){
    return view('permission_ajax');
});