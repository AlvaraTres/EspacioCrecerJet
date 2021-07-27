<?php

use Illuminate\Support\Facades\Route;
use App\Http\LiveWire\EnlistarFichasModal;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\PaymentController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/psicologos', function(){
    return view('psicologo.psicologos');
})->name('psicologos');

Route::middleware(['auth:sanctum', 'verified'])->get('/pacientes', function(){
    return view('paciente.pacientes');
})->name('pacientes');

Route::middleware(['auth:sanctum', 'verified'])->get('tags_trastornos', function(){
    return view('tag.tags');
})->name('tags_trastornos');

Route::middleware(['auth:sanctum', 'verified'])->get('reservas', function(){
    return view('reservas.reservas');
})->name('reservas');

Route::get('/fichaPdf/{ficha_id}', [EnlistarFichasModal::class, 'fichaPacientePdf']);

Route::get('/calendarioreservas', [ReservasController::class, 'index'])->name('calendarioreservas');

Route::middleware(['auth:sanctum', 'verified'])->get('horarios', function(){
    return view('horario.horario');
})->name('horarios');

Route::middleware(['auth:sanctum', 'verified'])->get('pagos', function(){
    return view('pagos.pagos');
})->name('pagos');

//RUTA DE PAGO CON PAYPAL
Route::get( '/payment/{date1}/{date2}/{date3}/{startTime}/{description}/{pid}', [PaymentController::class, 'payWithPayPal'])->name('payment');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::get('/payment/success/{fecha}/{description}/{pid}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/reserva_success/{reserva}', [PaymentController::class, 'successReserva'])->name('reservas.success');
Route::get('/payment/reserva_error', [PaymentController::class, 'errorReserva'])->name('reservas.error');