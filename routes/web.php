<?php

use App\Livewire\AddroomForm;
use App\Livewire\CheckinView;
use App\Livewire\CheckoutPage;
use App\Livewire\Reportpage;
use App\Livewire\ReservationPage;
use App\Livewire\RoomPage;
use App\Livewire\Staffpage;
use App\Livewire\UpdateRoom;
use App\Livewire\ViewRoom;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Addreservation;
Route::get('/', function () {
    return view('welcome');
})->name('home');


    //Route Dashbord///
    Route::middleware(['auth','verified','role:admin,staff'])->group(function(){

        Route::prefix('dashboard')->group(function(){  
              
        Route::view('/', 'dashboard')->name('dashboard')->middleware('role:admin,staff');
        
        Route::middleware('role:admin,staff,supper_admin')->prefix('/reservation')->group(function(){
            Route::get('/',ReservationPage::class)->name('reservationPage')->middleware('role:admin,staff,supper_admin');
            Route::get('/addReservation',Addreservation::class)->name('addReservation')->middleware('role:admin,staff,supper_admin');
        });
         
        
        Route::middleware('role:admin,staff,supper_admin')->prefix('/room')->group(function(){
            Route::get('/',RoomPage::class)->name('roompage')->middleware('role:admin,staff,supper_admin');
            Route::get('/addRoom',AddroomForm::class)->name('addroom')->middleware('role:admin,supper_admin');
            Route::get('/viewRoom/{room}',ViewRoom::class)->name('viewRoom')->middleware('role:admin,staff,supper_admin');
            Route::get('/updateRoom/{room}',UpdateRoom::class)->name('roomUpdate')->middleware('role:admin,supper_admin');
        });

        Route::get('/checin',CheckinView::class)->name('checkinpage')->middleware('role:admin,staff,supper_admin');
       
        Route::get('/checkout',CheckoutPage::class)->name('checkoutpage')->middleware('role:admin,staff,supper_admin');

        Route::get('/staffpage', Staffpage::class)->name('staffpage')->middleware('role:admin,staff,supper_admin');

        Route::get('/reportpage',Reportpage::class)->name('reportpage')->middleware('role:admin,staff,supper_admin');
        });
        
    });



Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
