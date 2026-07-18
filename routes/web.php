<?php

use App\Http\Controllers\Opportunity\ListingController;
use Illuminate\Support\Facades\Route;

// PUBLIC PAGES
Route::get('/', function () { return view('pages.home'); })->name('home');
Route::get('/about', function () { return view('pages.about'); })->name('about');
Route::get('/contact', function () { return view('pages.contact'); })->name('contact');

// OPPORTUNITY LISTING & DETAIL (real controller)
Route::get('/opportunities', [ListingController::class, 'index'])->name('opportunities.index');
Route::get('/opportunities/{opportunity}', [ListingController::class, 'show'])->name('opportunities.show');

// TYPE-SPECIFIC ALIASES (all point to same listing with filter)
Route::get('/scholarships', fn() => redirect()->route('opportunities.index', ['type' => 'scholarship']))->name('scholarships.index');
Route::get('/research-grants', fn() => redirect()->route('opportunities.index', ['type' => 'research_grant']))->name('research-grants.index');
Route::get('/internships', fn() => redirect()->route('opportunities.index', ['type' => 'internship']))->name('internships.index');
Route::get('/fellowships', fn() => redirect()->route('opportunities.index', ['type' => 'fellowship']))->name('fellowships.index');
Route::get('/competitions', fn() => redirect()->route('opportunities.index', ['type' => 'competition']))->name('competitions.index');

// STUDENT ROUTES
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', fn() => '<h1 class="p-10 text-2xl font-bold">Student Dashboard — Module 3</h1>')->name('dashboard');
    Route::get('/profile/edit', fn() => '<h1 class="p-10 text-2xl font-bold">Profile Edit — Module 3</h1>')->name('profile.edit');
    Route::get('/bookmarks', fn() => '<h1 class="p-10 text-2xl font-bold">Bookmarks — Module 5</h1>')->name('bookmarks.index');
    Route::get('/applications', fn() => '<h1 class="p-10 text-2xl font-bold">Applications — Module 4</h1>')->name('applications.index');
});

// FACULTY ROUTES
Route::middleware(['auth', 'role:faculty'])->prefix('faculty')->name('faculty.')->group(function () {
    Route::get('/dashboard', fn() => '<h1 class="p-10 text-2xl font-bold">Faculty Dashboard — Module 6</h1>')->name('dashboard');
    Route::get('/opportunities', fn() => '<h1 class="p-10 text-2xl font-bold">Faculty Opportunities — Module 6</h1>')->name('opportunities.index');
});

// ADMIN ROUTES
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => '<h1 class="p-10 text-2xl font-bold">Admin Dashboard — Module 7</h1>')->name('dashboard');
});

// NOTIFICATIONS
Route::post('/notifications/mark-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.mark-read')->middleware('auth');

// BREEZE AUTH
require __DIR__.'/auth.php';