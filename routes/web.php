<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
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
    return view('/customer/add-customer');
});
Route::get('/Users',function(){
    return view('/user/userlist');
});
Route::get('/UserProfile',function(){
    return view('/user/user-profile');
});
Route::post('/UpdateProfile',[UserController::class,'UpdateProfile']);
Route::get('/CustomersList', function (){
    return view('/customer/customerlist');
});
Route::get('/EditUser/{id}',function($id){
    return view('/user/edituser',['id'=>$id]);
});
Route::get('/AddUser',function(){
    return view('/user/adduser');
});
Route::post('/CreateUser',[UserController::class,'CreateUser']);
Route::get('/Logout',[UserController::class,'LogoutUser']);
Route::post('/UpdateUser',[UserController::class,'UpdateUser']);
Route::get('/Permissions',function(){
    return view('/permission/permissions');
});
Route::post('/permission',function(){
    return view('/permission/permission_ajax');
});
Route::post('/UpdateUserPermission',[UserController::class,'UpdateUserPermissions']);

Route::get('/department',[DepartmentController::class,'Index']);
Route::any('/department/create',[DepartmentController::class,'Create']);
Route::any('/department/delete',[DepartmentController::class,'Delete']);
Route::get('/designation',[DesignationController::class,'Index']);
Route::any('/designation/create',[DesignationController::class,'Create']);
Route::any('/designation/delete',[DesignationController::class,'Delete']);