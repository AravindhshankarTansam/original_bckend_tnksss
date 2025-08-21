<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;


Route::get('/admin/login', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

        // ADMIN Slider routes
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');      
    Route::get('/slider/create', [SliderController::class, 'create'])->name('admin.slider.create'); 
    Route::post('/slider/store', [SliderController::class, 'store'])->name('admin.slider.store');   
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->name('admin.slider.edit'); // <-- Add this
    Route::put('/slider/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');
   
});



Route::get('/public/sliders', [SliderController::class, 'public'])->name('sliders.public');


require __DIR__.'/auth.php';
