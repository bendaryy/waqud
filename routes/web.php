<?php

use App\Http\Controllers\petrolController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MainCarController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::resource('users',UserController::class);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        // Route::get('test', function () {
        //     dd(\App::getLocale());
        // });
        // Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::get('/', function () {
            if (Auth::check()) {
                return redirect()->route('dashboard');
            } else {
                return view('auth.login');

            }

        });

        Route::middleware(['auth'])->group(function () {
            // roles and permissions
            Route::resource('roles', RoleController::class);
            Route::resource('permissions', PermissionController::class);
            // users
            Route::resource('users', UserController::class);
            // sync companies
            Route::get('syncCompany/{id}', [UserController::class, 'EditsyncCompanies'])->name('EditsyncCompany');
            Route::post('syncCompany/{id}', [UserController::class, 'AddsyncCompanies'])->name('AddsyncCompany');
            // detach companies
            Route::get('detachCompany/{id}', [UserController::class, 'EditDetachCompanies'])->name('EditDetachCompany');
            Route::delete('detachCompany/{id}', [UserController::class, 'DetachCompanies'])->name('detachCompanies');
            // companies
            Route::resource('company', CompanyController::class);
            // dashboard
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
            // main cars
            Route::resource('main-cars', MainCarController::class);
            // sub cars
            Route::resource('subcar', SubCarController::class)->except('show');
            Route::get('subcar/carId={companyId}/companyId={companyCar}',[SubCarController::class,'show'])->name('subcar.show');
            Route::resource('petrol', petrolController::class);

        });
        // Route::get('/storage-link', function () {
        //     Artisan::call('storage:link');
        //     return 'The links have been created.';
        // });

        // Route::get('test', [UserController::class, 'test']);

    });
