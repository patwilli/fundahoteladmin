<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomsController;
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

Route::group(['middleware' => 'authHotelAdmin'], function () {
    // Les routes qui nécessitent une authentification ici
    Route::get('/', [DashboardController::class, 'indexDashboard']);

    Route::get('/Dashboard', [DashboardController::class, 'indexDashboard'])->name('dashboard');

    Route::get('/All-Rooms', [RoomsController::class, 'indexAllRooms'])->name('all-rooms');

    Route::get('/Rooms-Items', [RoomsController::class, 'indexRoomsItems'])->name('indexRoomsItems');

    Route::get('/Add-Rooms', [RoomsController::class, 'indexAddRoom'])->name('add-room-form');

    Route::post('/Adding-room', [RoomsController::class, 'addRoom'])->name('add-room');

    Route::get('/Edit-room-{id}', [RoomsController::class, 'indexAddRoom1'])->name('edit-room-form');

    Route::post('/Update-room', [RoomsController::class, 'editRoom'])->name('edit-room');

    Route::get('/Allclients', [ClientsController::class, 'indexClients'])->name('all-client');

    Route::get('/Unbanclient-{id}', [ClientsController::class, 'unbanClient'])->name('unban-client');

    Route::get('/Banclient-{id}', [ClientsController::class, 'banClient'])->name('ban-client');

    Route::get('/addbooking', [RoomsController::class, 'indexNewBookings'])->name('indexNewBookings');

    Route::get('/prevbooking', [RoomsController::class, 'indexOlderBookings'])->name('indexOlderBookings');

    Route::get('/Invoices', [RoomsController::class, 'indexInvoices'])->name('indexInvoices');

    Route::get('/Manageaccounts', [AdminsController::class, 'indexManageAccounts'])->name('indexManageAccounts');

    Route::post('/Addusr', [AdminsController::class, 'addAdmin'])->name('addAdmin');

    Route::post('/Updusr', [AdminsController::class, 'updateAdmin'])->name('updateAdmin');

    Route::post('/Updbanusr', [AdminsController::class, 'updateBanAdmin'])->name('updateBanAdmin');

    Route::post('/Updunbanusr', [AdminsController::class, 'updateUnbanAdmin'])->name('updateUnbanAdmin');

    // Route::get('/Cancel booking-{id}', [RoomsController::class, 'cancelBooking'])->name('cancelBooking');

    // Route::get('/Confirmed booking-{id}', [RoomsController::class, 'confirmedBooking'])->name('confirmedBooking');

    Route::get('/Geninv', [RoomsController::class, 'generatePdf'])->name('generatePdf');

    Route::get('/getRoomItems/{bookingId}', [RoomsController::class, 'getRoomItems'])->name('getRoomItems');

    Route::post('/updstatbooking', [RoomsController::class, 'updateStatusBooking'])->name('updateStatusBooking');

    Route::post('/newbooking', [RoomsController::class, 'addNewBooking'])->name('addNewBooking');

    Route::get('/updstatpaidinv-{id}', [RoomsController::class, 'updatePaidInvoice'])->name('updatePaidInvoice');

    Route::get('/updstatclinv-{id}', [RoomsController::class, 'updateClosedInvoice'])->name('updateClosedInvoice');

    Route::post('/invoices/add', [RoomsController::class, 'invoiceEdit']);
});

Route::get('/Login-Form', [AdminsController::class, 'loginForm'])->name('loginForm');

Route::post('/Login', [AdminsController::class, 'login'])->name('login');

Route::get('/logout', [AdminsController::class, 'logout'])->name('logout');
