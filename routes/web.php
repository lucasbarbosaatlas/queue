<?php

use App\Jobs\MakeOrderJob;
use App\Jobs\RunPaymentJob;
use App\Jobs\ValidateCardJob;
use App\Jobs\SendNotificationJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;
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

Route::get('send-notification-all', function () {
    SendNotificationJob::dispatch();
});

Route::get('run-batch', function () {

    Bus::batch([
        new MakeOrderJob,
        new RunPaymentJob,
        new ValidateCardJob
    ])->name('Run Batch', rand(1,10))->dispatch();

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
