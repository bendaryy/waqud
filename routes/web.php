<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\companyuser\myCompaniesController;
use App\Http\Controllers\MainCarController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PetrolController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\stationuser\stationUserController;
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
            Route::get('userCompany', [UserController::class, 'companyUser'])->name('users.companyuser');
            Route::get('stationuser', [UserController::class, 'stationUser'])->name('users.stationuser');
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
            Route::get('subcar/carId={companyId}/companyId={companyCar}/carLetters={carLetters}/carNumbers={carNumbers}/carModel={carModel}', [SubCarController::class, 'show'])->name('subcar.show');
            Route::resource('petrol', PetrolController::class);

            //start companyUser section
            Route::resource('companyUserSection', myCompaniesController::class);
            Route::get('companyCars/{id}', [myCompaniesController::class, 'cars'])->name('companyCars');
            // all times
            Route::get('carpetrol/{id}', [myCompaniesController::class, 'carPetrol'])->name('carpetrol');
            // this week
            Route::get('carpetrolThisWeek/{id}', [myCompaniesController::class, 'carPetrolThisWeek'])->name('carPetrolThisWeek');
            // this month
            Route::get('carpetrolThisMonth/{id}', [myCompaniesController::class, 'carPetrolThisMonth'])->name('carPetrolThisMonth');
            // last month
            Route::get('carpetrolLastMonth/{id}', [myCompaniesController::class, 'carPetrolLastMonth'])->name('carPetrolLastMonth');
            // this last week
            Route::get('carpetrolLastWeek/{id}', [myCompaniesController::class, 'carPetrolLastWeek'])->name('carPetrolLastWeek');
            Route::get('companypetrol/{id}', [myCompaniesController::class, 'companyPetrol'])->name('companypetrol');
            Route::get('kilopetrol/{id}', [myCompaniesController::class, 'editKilo'])->name('kilopetrol');

            // from date to date
            Route::get('fromdatetodate/{id}', [myCompaniesController::class, 'fromDateToDate'])->name('searchbydate');
        });
        //end companyUser section


        //  end station user section
        Route::resource('station', stationUserController::class);
            //  start station user section

        // Route::get('/storage-link', function () {
        //     Artisan::call('storage:link');
        //     return 'The links have been created.';
        // });

        // Route::get('test', [UserController::class, 'test']);

    });
