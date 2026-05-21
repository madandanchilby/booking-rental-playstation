<?php

use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Auth\Register;
use App\Livewire\Customer\Auth\Login as CustomerLogin;
use App\Livewire\Customer\Auth\Register as CustomerRegister;
use App\Livewire\Pages\Admin\Booking\WalkinBookingCreate;
use App\Livewire\Pages\Admin\HistoryList as AdminHistoryList;
use App\Livewire\Pages\Admin\MasterData\Computer\ComputerCreate;
use App\Livewire\Pages\Admin\MasterData\Computer\ComputerEdit;
use App\Livewire\Pages\Admin\MasterData\Computer\ComputerList;
use App\Livewire\Pages\Admin\MasterData\Computer\ComputerView;
use App\Livewire\Pages\Customer\BookingCreate;
use App\Livewire\Pages\Customer\BookingInvoice;
use App\Livewire\Pages\Customer\BookingList;
use App\Livewire\Pages\Customer\BookingPayment;
use App\Livewire\Pages\Customer\BookingReschedule;
use App\Livewire\Pages\Customer\HistoryList;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// auth admin routes
Route::get('admin/auth/register', Register::class)->name('admin.auth.register');
Route::get('admin/auth/login', Login::class)->name('admin.auth.login');
Route::get('customer/auth/register', CustomerRegister::class)->name('customer.auth.register');
Route::get('customer/auth/login', CustomerLogin::class)->name('customer.auth.login');

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('customer.auth.login')->with('status', 'Email berhasil diverifikasi. Silakan login.');
    })->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('customer.booking');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.auth.login');
    })->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('master-data')->group(function () {
        Route::get('komputer', ComputerList::class)->name('admin.master-data.computer');
        Route::get('komputer/create', ComputerCreate::class)->name('admin.master-data.computer.create');
        Route::get('komputer/view/{computer}', ComputerView::class)->name('admin.master-data.computer.view');
        Route::get('komputer/edit/{computer}', ComputerEdit::class)->name('admin.master-data.computer.edit');
    });

    Route::get('/', AdminHistoryList::class)->name('admin.history');
    Route::get('/booking/walk-in', WalkinBookingCreate::class)->name('admin.booking.walkin');
});

Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::get('/', BookingList::class)->name('customer.booking');
    Route::get('/bookings/{computer}/create', BookingCreate::class)->name('customer.booking.create');
    Route::get('/bookings/payment/{order_id}', BookingPayment::class)->name('customer.booking.payment');
    Route::get('/bookings/invoice/{order_id}', BookingInvoice::class)->name('customer.booking.invoice');
    Route::get('/bookings/{booking}/reschedule', BookingReschedule::class)->name('customer.booking.reschedule');
    Route::get('/histories', HistoryList::class)->name('customer.history');
});
