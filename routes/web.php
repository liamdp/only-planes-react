<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AircraftController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register')
//     ]);
// });

Route::get('/', function () {
    return redirect("/login");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // interactions
    Route::get("/interactions", [OpinionController::class, "index"]);
    Route::delete("/interactions", [OpinionController::class, "destroy"]);

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// files
Route::prefix("/resources")->group(function () {

    Route::middleware('auth')->group(function () {

        Route::controller(ImageController::class)->group(function() {
            // Route::get("/{name}", "getImage");
            Route::post("/upload", "store");
        });

    });

});

// api
Route::prefix("/api")->group(function () {

    // authenticated only
    Route::middleware('auth')->group(function () {
        // aircraft
        Route::controller(AircraftController::class)->group(function () {
            Route::get("/all-aircraft", "index");
            Route::get("/all-aircraft/{page}", "paginatedIndex");
            Route::get("/aircraft/{id}", "show");
            Route::post("/aircraft/create", "store");
        });

        // user
        Route::controller(UserController::class)->group(function () {
            Route::get("/users", "index");
            Route::get("/users/{id}", "show");
        });

        // Actions
        Route::controller(OpinionController::class)->group(function () {
            Route::post("/opinions", "store");
        });
    });
});

require __DIR__ . '/auth.php';
