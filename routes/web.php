<?php

use App\Http\Controllers\GreetingController;
use App\Http\Controllers\SetCookieController;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/favicon.ico', function () {
    return response('', 204);
})->withoutMiddleware([
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    StartSession::class,
    ShareErrorsFromSession::class,
    VerifyCsrfToken::class,
]);

Route::get('/setcookie', SetCookieController::class);

Route::withoutMiddleware([
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    StartSession::class,
    ShareErrorsFromSession::class,
    VerifyCsrfToken::class,
])->group(function () {
    Route::get('/stateless', [GreetingController::class, 'statelessIndex'])->name('stateless.index');
    Route::post('/stateless', [GreetingController::class, 'statelessStore'])->name('stateless.store');
});

Route::get('/stateful', [GreetingController::class, 'statefulIndex'])->name('stateful.index');
Route::post('/stateful', [GreetingController::class, 'statefulStore'])->name('stateful.store');
