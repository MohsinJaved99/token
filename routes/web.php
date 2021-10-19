<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use App\Models\Branch;
use App\Models\Counter;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Nexmo\Laravel\Facade\Nexmo;
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



// Route::get('/layout', function () {
//     return view('layout.app');
// });

Route::get('/login', function () {
    
 
    if(!empty(session('id'))) {
        return redirect()->route('index-route');
    }
    elseif(!empty(session('adminid'))) {
        return redirect()->route('admin-route');
    }
    else {
        return view('login');
    }
})->name('login-route');

Route::get('/tokenInfo/{id}/{link}',[TokenController::class,'gettokeninfo']);

Route::post('/login', [UserController::class,'loginAuth']);


Route::group(['middleware' => 'checksession'], function () {

Route::get('/', function () {
        return redirect()->route('index-route');
});

Route::get('/index', [UserController::class,'index'])->name('index-route');
    
    
Route::get('/logout', function () {
        session()->pull('email');
        session()->pull('id');
        session()->pull('adminemail');
        session()->pull('adminid');
        return redirect('login');
});
    
    
    Route::post('/index/new', [TokenController::class, 'createNewToken']);
    
    Route::get('/getTotaltoken/{id}',[TokenController::class,'gettokenttl']);
    
    Route::get('/getBranchToken/{id}',[TokenController::class,'getbranchtoken']);

    Route::get('/getBranchData/{id}',[TokenController::class,'getbranchdata']);
    
  
    
    Route::get('/getActiveToken/{id}', [TokenController::class,'getActiveToken']);

    Route::get('/getbranchfortoken/{id}/{search}', [TokenController::class,'getbranchfortokenpage']);
    
    Route::post('/index', [TokenController::class, 'nextToken'])->name('next');
    
    Route::post('/index/back', [TokenController::class, 'backToken'])->name('back');

    Route::get('deleteToken/{id}',[TokenController::class,'deleteToken']);

    Route::get('editToken/{id}',[TokenController::class,'editToken']);

    Route::post('/editToken',[TokenController::class,'updateToken']);

    
    
    Route::get('/tokens', [TokenController::class,'tokens'])->name('token-route');

    Route::post('/operators', [AdminController::class,'createOperator']);
    
    Route::get('/operators', [AdminController::class,'operators'])->name('operator-route');
    
    Route::get('/operator/delete/{id}', [AdminController::class,'deleteOperator']);
    Route::get('/operator/active/{id}', [AdminController::class,'activeOperator']);

    Route::get('/branches', [AdminController::class,'branches'])->name('branch-route');

    Route::post('/branches', [AdminController::class,'createBranch']);



    Route::get('/branches/edit/{id}', [AdminController::class,'geteditBranch']);

    Route::post('/branches/edit', [AdminController::class,'editBranch']);
    Route::get('/branches/delete/{id}', [AdminController::class,'deleteBranch']);

    Route::get('/profile', [UserController::class,'profile'])->name('profile-route');

    Route::post('/profile', [UserController::class,'editProfile']);

    Route::post('/changepassword', [UserController::class,'editPassword']);
    
   
});
//Trying Api
// Route::get('/users/{id}', function ($id) {
//     return view('updateApi',['id'=>$id]);
// });