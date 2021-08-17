<?php

use Illuminate\Support\Facades\Route;
use App\Http\LiveWire\EnlistarFichasModal;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\PaymentController;
use App\Http\Livewire\VerPacienteInfoModal;

use App\Models\Paciente;
use App\Models\Reserva;
use App\Models\User;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/roles', function () {
    return view('roles.roles');
})->name('roles');

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
Route::get('/downloadFile/{ficha_id}', [EnlistarFichasModal::class, 'downloadFileFichaPaciente']);
Route::get('downloadCert/{paciente_id}', [VerPacienteInfoModal::class, 'downloadCertificado']);


Route::middleware(['auth:sanctum', 'verified'])->get('horarios', function(){
    return view('horario.horario');
})->name('horarios');

Route::middleware(['auth:sanctum', 'verified'])->get('pagos', function(){
    return view('pagos.pagos');
})->name('pagos');

Route::middleware(['auth:sanctum', 'verified'])->get('misPagos', function(){
    return view('pagos.misPagos');
})->name('misPagos');

//RUTAS DE REPORTES
Route::middleware(['auth:sanctum', 'verified'])->get('/reportePagos', function(){
    return view('reportes.pagos');
})->name('reportePagos');

Route::middleware(['auth:sanctum', 'verified'])->get('/reportePacientes', function(){
    return view('reportes.pacientes');
})->name('reportePacientes');

Route::middleware(['auth:sanctum', 'verified'])->get('/reporteReservas', function(){
    return view('reportes.reservas');
})->name('reporteReservas');

Route::middleware(['auth:sanctum', 'verified'])->get('/reporteCategorias', function(){
    return view('reportes.categorias');
})->name('reporteCategorias');

//RUTA DE PAGO CON PAYPAL
Route::get( '/payment/{date1}/{date2}/{date3}/{startTime}/{description}/{pid}/{paci}', [PaymentController::class, 'payWithPayPal'])->name('payment');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
Route::get('/payment/success/{fecha}/{description}/{pid}/{paci}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/reserva_success/{reserva}/{paci}', [PaymentController::class, 'successReserva'])->name('reservas.success');
Route::get('/payment/reserva_error', [PaymentController::class, 'errorReserva'])->name('reservas.error');

//Ruta prueba de correo
Route::get('/pruebaCorreo', function(){
    $paciente = Paciente::first();
    $reserva = Reserva::latest()->first();
    $psicologo = User::where('id_users_rol', '=', 2)->latest()->first();

    $correo = new ContactoMailable($paciente, $reserva, $psicologo);

    Mail::to($paciente->email)->send($correo);

    return "correo enviado";
});

