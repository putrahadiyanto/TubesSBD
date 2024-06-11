<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;


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
    return view('index');
})->name('home');

Route::get('/booking', [BookingController::class, 'enterEmail'])->name('booking');
Route::post('/booking/email', [BookingController::class, 'processEmail'])->name('email');
Route::get('/booking/enter-phone', [BookingController::class, 'enterPhone'])->name('enterPhone');
Route::post('/booking/telepon', [BookingController::class, 'processPhone'])->name('telepon');
Route::get('/booking/data/{id_peminjam}', [BookingController::class, 'create'])->name('bookingstore');
Route::post('/booking/store', [BookingController::class, 'store'])->name('store.booking');
Route::get('/event/summary/{id}', [BookingController::class,'summary'])->name('event');
Route::get('/booking/{id}/equipment', [BookingController::class, 'createEquipment'])->name('createEquipment');
Route::post('/booking/{id}/equipment/store', [BookingController::class, 'storeEquipment'])->name('storeEquipment');

Route::get('/dashboard', function(){
    return('admin.dashboard');
});


Route::resource('/admin/event', EventController::class);
Route::resource('/admin/member', MemberController::class);
Route::resource('/admin/equipment', EquipmentController::class);
Route::resource('/admin/booking', BookingController::class);

Route::get('/admin', function(){
    return view('admin.dashboard');
});

