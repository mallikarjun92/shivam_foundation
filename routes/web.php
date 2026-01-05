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

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'listBlogs'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'showBlogDetail'])->name('blog.showBlogDetail');
});

// About routes
Route::get('/about-us', [AboutController::class, 'index'])->name('about');

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
Route::get('/events', [EventController::class, 'listEvents'])->name('events.list');
Route::get('/events/{event}', [EventController::class, 'showEvent'])->name('events.show');

// volunteers routes
Route::get('/about-us/volunteers', [App\Http\Controllers\VolunteerController::class, 'index'])->name('volunteers.index');
Route::get('/volunteers/{id}', [App\Http\Controllers\VolunteerController::class, 'show'])->name('volunteers.show');

// Programs routes
Route::get('/programs', [App\Http\Controllers\ProgramsController::class, 'allprograms'])->name('programs.index');
Route::get('/programs/yoga', [App\Http\Controllers\ProgramsController::class, 'yoga'])->name('programs.yoga');
Route::post('/programs/enroll', [App\Http\Controllers\ProgramsController::class, 'enrollProgram'])->name('programs.enroll');
Route::get('/programs/ramayana', [App\Http\Controllers\ProgramsController::class, 'ramayana'])->name('programs.ramayana');

// CSR fund page
Route::get('/csr', [App\Http\Controllers\CSRController::class, 'index'])->name('csr.index');
Route::get('/csr2', [App\Http\Controllers\CSRController::class, 'index2'])->name('csr.index2');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin maintenance routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin/maintenance')->name('admin.maintenance.')->group(function () {
    // ... existing routes ...
    
    Route::get('/migrations', [MaintenanceController::class, 'migrations'])->name('migrations');
    Route::post('/get-migration-sql', [MaintenanceController::class, 'getMigrationSql'])->name('get-migration-sql');
    Route::post('/execute-sql', [MaintenanceController::class, 'executeSql'])->name('execute-sql');
    Route::post('/run-migration', [MaintenanceController::class, 'runMigration'])->name('run-migration');
    Route::post('/rollback-migration', [MaintenanceController::class, 'rollbackMigration'])->name('rollback-migration');
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
        // Blog image upload for CKEditor
        Route::post('blogs/upload-image', [\App\Http\Controllers\Admin\BlogController::class, 'uploadImage'])->name('blogs.upload-image');

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

        // programs enrollment management
        Route::resource('programs-enrollments', App\Http\Controllers\Admin\ProgramsEnrollmentController::class);

        Route::resource('statistics', App\Http\Controllers\Admin\StatisticController::class);

        Route::resource(
            'impact-reports',
            App\Http\Controllers\Admin\ImpactReportController::class
        );

        Route::resource('teams', App\Http\Controllers\Admin\TeamController::class);

        // Contact messages
        Route::get('contacts', [ContactController::class, 'listMessages'])->name('contacts.index');
        Route::get('contacts/{id}', [ContactController::class, 'showMessage'])->name('contacts.show');
        Route::delete('contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.delete');

        // Donations management
        Route::get('donations', [DonationController::class, 'adminIndex'])->name('donations.index');
        Route::get('donations/{id}', [DonationController::class, 'adminShow'])->name('donations.show');
        // Route::get('donations/edit/{id}', [DonationController::class, 'edit'])->name('donations.edit');
        // Route::put('/admin/donations/{id}', [DonationController::class, 'update'])->name('admin.donations.update');
        Route::get('donations/{id}/edit', [DonationController::class, 'edit'])->name('donations.edit');
        Route::put('donations/{id}', [DonationController::class, 'update'])->name('donations.update');

        // Maintenance routes
        Route::get('maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('maintenance/fix-storage', [MaintenanceController::class, 'fixStorage'])->name('maintenance.fix-storage');
        Route::post('maintenance/fix-symlink', [MaintenanceController::class, 'fixSymlink'])->name('maintenance.fix-symlink');
        Route::get('maintenance/status', [MaintenanceController::class, 'checkStatus'])->name('maintenance.status');

    });

require __DIR__.'/auth.php';
