<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HeroContentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\FeaturedDonorController;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/storage/{filename}', function ($filename) {
//     $paths = [
//         storage_path('app/public/' . $filename),   // main Laravel storage
//         public_path('storage/' . $filename),       // fallback public/storage
//     ];

//     foreach ($paths as $path) {
//         if (file_exists($path)) {
//             return response()->file($path);
//         }
//     }

//     abort(404, 'File not found');
// });

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'listBlogs'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'showBlogDetail'])->name('blog.showBlogDetail');
});

// About routes
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Add these routes to your existing web.php
Route::get('/donate', [DonationController::class, 'index'])->name('donate.index');
Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');
Route::get('/donate/confirmation/{id}', [DonationController::class, 'confirmation'])->name('donate.confirmation');
Route::post('/donate/update-transaction/{id}', [DonationController::class, 'updateTransaction'])->name('donate.update-transaction');

// Gallery routes
Route::get('/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->name('gallery.index');

// Frontend events routes
// Route::get('/events', [EventController::class, 'frontendIndex'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'showEvent'])->name('events.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes with 'auth' and 'role:admin' middleware
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Posts resource
        Route::resource('posts', PostController::class);
        
        // Blogs resource
        Route::resource('blogs', BlogController::class);

        // Volunteers resource
        Route::resource('volunteers', App\Http\Controllers\Admin\VolunteerController::class);

        // Gallery resource
        Route::resource('galleries', GalleryController::class);

        // Hero Content resource
        Route::resource('hero', HeroContentController::class);

        // Events resource
        Route::resource('events', EventController::class);

        // Featured Donors resource
        Route::resource('donors', FeaturedDonorController::class);

        // Contact messages
        Route::get('contacts', [ContactController::class, 'listMessages'])->name('contacts.index');
        Route::get('contacts/{id}', [ContactController::class, 'showMessage'])->name('contacts.show');

        // Donations management
        Route::get('donations', [DonationController::class, 'adminIndex'])->name('donations.index');
        Route::get('donations/{id}', [DonationController::class, 'adminShow'])->name('donations.show');

        // Maintenance routes
        Route::get('maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('maintenance/fix-storage', [MaintenanceController::class, 'fixStorage'])->name('maintenance.fix-storage');
        Route::post('maintenance/fix-symlink', [MaintenanceController::class, 'fixSymlink'])->name('maintenance.fix-symlink');
        Route::get('maintenance/status', [MaintenanceController::class, 'checkStatus'])->name('maintenance.status');

    });

require __DIR__.'/auth.php';
