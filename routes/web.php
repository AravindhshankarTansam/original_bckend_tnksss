<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeroTextController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\GalleryController;

Route::get('/admin/login', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // ✅ ADMIN Header routes
    Route::get('/header', [HeaderController::class, 'index'])->name('admin.header.index');      
    Route::get('/header/create', [HeaderController::class, 'create'])->name('admin.header.create'); 
    Route::post('/header/store', [HeaderController::class, 'store'])->name('admin.header.store');   
    Route::get('/header/{header}/edit', [HeaderController::class, 'edit'])->name('admin.header.edit'); 
    Route::put('/header/{header}', [HeaderController::class, 'update'])->name('admin.header.update');

    // ✅ ADMIN Slider routes
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');      
    Route::get('/slider/create', [SliderController::class, 'create'])->name('admin.slider.create'); 
    Route::post('/slider/store', [SliderController::class, 'store'])->name('admin.slider.store');   
    Route::get('/slider/{slider}/edit', [SliderController::class, 'edit'])->name('admin.slider.edit'); 
    Route::put('/slider/{slider}', [SliderController::class, 'update'])->name('admin.slider.update');

    // ✅ ADMIN Footer routes (same style as Header & Slider)
    Route::get('/footer', [FooterController::class, 'index'])->name('admin.footer.index');      
    Route::get('/footer/create', [FooterController::class, 'create'])->name('admin.footer.create'); 
    Route::post('/footer/store', [FooterController::class, 'store'])->name('admin.footer.store');   
    Route::get('/footer/{footer}/edit', [FooterController::class, 'edit'])->name('admin.footer.edit'); 
    Route::put('/footer/{footer}', [FooterController::class, 'update'])->name('admin.footer.update');

    Route::get('/hero-text', [HeroTextController::class, 'index'])->name('admin.hero.index');
    Route::get('/hero-text/create', [HeroTextController::class, 'create'])->name('admin.hero.create');
    Route::post('/hero-text/store', [HeroTextController::class, 'store'])->name('admin.hero.store');
    Route::get('/hero-text/{heroText}/edit', [HeroTextController::class, 'edit'])->name('admin.hero.edit');
    Route::put('/hero-text/{heroText}', [HeroTextController::class, 'update'])->name('admin.hero.update');

    // Admin About Us
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('admin.about.index');
    Route::get('/about-us/create', [AboutUsController::class, 'create'])->name('admin.about.create');
    Route::post('/about-us/store', [AboutUsController::class, 'store'])->name('admin.about.store');
    Route::get('/about-us/{about}/edit', [AboutUsController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about-us/{about}', [AboutUsController::class, 'update'])->name('admin.about.update');

    // Admin Gallery 
    Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('admin.gallery.update');
});

// Public slider route (optional)
Route::get('/public/sliders', [SliderController::class, 'public'])->name('sliders.public');
// Public footer route
Route::get('/public/footers', [FooterController::class, 'public'])->name('footers.public');
// Public hero texts route
Route::get('/public/hero-texts', [HeroTextController::class, 'public'])->name('hero-texts.public');
// Public About Us
Route::get('/public/about-us', [AboutUsController::class, 'public'])->name('about-us.public');
// Public Gallery
Route::get('/public/galleries', [GalleryController::class, 'public'])->name('galleries.public');



require __DIR__.'/auth.php';