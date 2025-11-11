<?php

use App\Livewire\AddroomForm;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');


    //Route Dashbord///


    Route::middleware(['auth', 'verified'])->group(function(){

        Route::prefix('dashboard')->group(function(){  
              
        Route::view('/', 'dashboard')->name('dashboard')->middleware('role');

        Route::get('/reservation',ReservationPage::class)->name('reservationPage')->middleware('role');   
        
        Route::middleware('role')->prefix('/room')->group(function(){
            Route::get('/',RoomPage::class)->name('roompage')->middleware('role');
            Route::get('/addRoom',AddroomForm::class)->name('addroom');
            Route::get('/viewRoom/{room}',ViewRoom::class)->name('viewRoom');
            Route::get('/updateRoom/{room}',UpdateRoom::class)->name('roomUpdate');
        });
       
        Route::get('/checkout',CheckoutPage::class)->name('checkoutpage')->middleware('role');

        Route::get('/staffpage', Staffpage::class)->name('staffpage')->middleware('role');

        Route::get('/reportpage',Reportpage::class)->name('reportpage')->middleware('role');
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
