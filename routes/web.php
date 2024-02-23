<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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

Auth::routes(['verify' => true, 'register' => true]);

Route::group(['middleware' => ['auth']], function(){

    // Route::resource('service', ServiceController::class);
    // Route::post('/service/updates-status-process', [ServiceController   ::class, 'updateStatus'])->name('service.update.status');
    // Route::get('/services/trash', [ServiceController::class, 'trash'])->name('service.trash');
    // Route::post('/service/restore', [ServiceController::class, 'restoreService'])->name('service.restore');
    
});

Route::controller(FrontendController::class)->name('front.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/send-sms', 'sendSms');
    
    Route::get('/forgot-password', function () {
        return view('auth.passwords.email');
    })->middleware('guest')->name('password.request');
    
    Route::get('register-step1', 'registerStep1')->name('register.step1')->middleware(['auth']);
    Route::post('register-step2-continue', 'registerStep1Process')->name('register.step1Process');

    Route::get('register-step2', 'registerStep2')->name('register.step2')->middleware('auth');
    Route::post('payments', 'registerStep2Process')->name('register.step2.process');

    Route::post('add-students', 'addStudents')->name('add.students')->middleware('auth');
    
    Route::get('thank-you','thankyou')->name('thank.you');
    Route::post('check-students','checkStudents')->name('checkStudents');


    Route::post('/registration-process', [RegisterController::class, 'registerProcess'])->name('register.process');
    Route::get('payment-failed' , [FrontendController::class, 'paymentFailed'])->name('paymnet.failed');

});

Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('admin.login');
    });
    // Route::get('/user/login', 'userLogin')->name('user.login');
    Route::get('/user/login', 'adminLogin')->name('admin.login');
    Route::post('/login-process', 'loginProcess')->name('login.process');

    // Route::get('/login/{social}', 'socialLogin')->where('social', 'twitter|facebook|linkedin|google|github|bitbucket')->name('social.login');
    // Route::get('/login/{social}/callback', 'handleProviderCallback')->where('social', 'twitter|facebook|linkedin|google|github|bitbucket')->name('social.login.callback');
});



Route::middleware(['auth'])->controller(DashboardController::class)->name('user.')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::get('/home', function () {
    return redirect()->route('admin.login');
})->name('home');


Route::get('/clear', function(){
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    // Artisan::call('queue:work');
    dd(Artisan::output());
});

