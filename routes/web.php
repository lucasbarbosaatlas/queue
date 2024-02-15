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



/* INVOICE */

Route::get('/invoice', [App\Http\Controllers\UserController::class, 'index'])->name('invoice');
Route::get('/invoice/edit/{invoice}', [App\Http\Controllers\UserController::class, 'edit'])->name('invoice.edit');
Route::post('/invoice', [App\Http\Controllers\UserController::class, 'store'])->name('invoice.store');
Route::delete('invoice/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('invoice.destroy');


/* Route::post('/invoice/update/{invoice}', [App\Http\Controllers\UserController::class, 'update'])->name('invoice.update')
    ->middleware('can:can-edit,invoice'); */
 
/* Sem middleware para recuperar a mensagem */
Route::post('/invoice/update/{invoice}', [App\Http\Controllers\UserController::class, 'update'])->name('invoice.update');

/* Route::post('/invoice', [App\Http\Controllers\UserController::class, 'store'])->name('invoice.store')
    ->middleware('isAdmin', App\Models\Invoice::class);*/


/* Route::post('/invoice', [App\Http\Controllers\UserController::class, 'store'])->name('invoice.store')
    ->can('isAdmin', App\Models\Invoice::class);  */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
