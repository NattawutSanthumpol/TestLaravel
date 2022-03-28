<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ServiceController;


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
})->name('home');

//การสร้าง Route
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/member',[MemberController::class,'index'])->name('mem');
Route::get('/admin',[AdminController::class,'index'])->name('admin')->middleware('check');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // มาจาก Model
    // $user = User::all();

    // เรียกใช้ DB
    $user = DB::table('users')->get();
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::middleware(['auth:sanctum','verified'])->group(function(){
    // Department
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('/department/add',[DepartmentController::class,'store'])->name('addDepartment');
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);
    Route::post('/department/update/{id}',[DepartmentController::class,'update']);
    //Softdelete
    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']);
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
    Route::get('/department/delete/{id}',[DepartmentController::class,'delete']);

    //Service
    Route::get('/service/all',[ServiceController::class,'index'])->name('service');
    Route::post('/service/add',[ServiceController::class,'store'])->name('addService');
    Route::get('/service/edit/{id}',[ServiceController::class,'edit']);
    Route::post('/service/update/{id}',[ServiceController::class,'update']);
    Route::get('/service/delete/{id}',[ServiceController::class,'delete']);

});


// Route::get('/users/{fname}/{lname}',function($fname,$lname){
//     echo "<h1>ชื่อ : $fname</h1>";
//     echo "<h1>นามสกุล : $lname</h1>";
// });

// Route::get('/products/{name}/{price}',function($name,$price){
//     echo "<h1>ชื่อสินค้า : $name</h1>";
//     echo "<h1>ราคาสินค้า : $price</h1>";
// });
