<?php 

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryAdvanceController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\SalesController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProductionReportController;
use App\Http\Controllers\Admin\SalesReportController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');   // Public landing page
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])
        ->name('attendance');

    Route::post('/attendance/load-week', [AttendanceController::class, 'loadWeek'])
        ->name('attendance.loadWeek');

    Route::post('/attendance/save', [AttendanceController::class, 'save'])
        ->name('attendance.save');

    Route::get('/attendance/edit/{id}', [AttendanceController::class, 'edit'])
        ->name('attendance.edit');

    Route::post('/attendance/update/{id}', [AttendanceController::class, 'update'])
        ->name('attendance.update');

    Route::get('/attendance/delete/{id}', [AttendanceController::class, 'delete'])
        ->name('attendance.delete');

    Route::get('/attendance-summary', [AttendanceController::class, 'summary'])
        ->name('attendance.summary');

    // Salary advances (worker)
    Route::get('/advance', [SalaryAdvanceController::class, 'index'])
        ->name('advance');

    Route::post('/advance/save', [SalaryAdvanceController::class, 'save'])
        ->name('advance.save');

    // Change password
    Route::get('/change-password', [PasswordController::class, 'show'])
        ->name('password.change');

    Route::post('/change-password', [PasswordController::class, 'update'])
        ->name('password.update');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    /*
    |--------------------------------------------------------------------------
    | PRODUCTION ROUTES
    |--------------------------------------------------------------------------
    */

    Route::get('/production', [ProductionController::class, 'dashboard'])
        ->name('production.dashboard');

    Route::get('/production/record', [ProductionController::class, 'create'])
        ->name('production.record');

    Route::post('/production/store', [ProductionController::class, 'store'])
        ->name('production.store');

    Route::get('/production/daily', [ProductionController::class, 'daily'])
        ->name('production.daily');

    Route::get('/production/edit/{id}', [ProductionController::class, 'edit'])
        ->name('production.edit');

    Route::post('/production/update/{id}', [ProductionController::class, 'update'])
        ->name('production.update');

    Route::get('/production/delete/{id}', [ProductionController::class, 'delete'])
        ->name('production.delete');

    // Product sizes
    Route::get('/production/sizes', [ProductSizeController::class, 'index'])
        ->name('production.sizes');

    Route::post('/production/sizes/store', [ProductSizeController::class, 'store'])
        ->name('production.sizes.store');

    Route::get('/production/sizes/delete/{id}', [ProductSizeController::class, 'delete'])
        ->name('production.sizes.delete');

    Route::get('/production/sizes/load/{typeId}', [ProductSizeController::class, 'loadByType'])
        ->name('production.sizes.load');

    /*
    |--------------------------------------------------------------------------
    | SALES ROUTES
    |--------------------------------------------------------------------------
    */

    Route::get('/sales', [SalesController::class, 'index'])
        ->name('sales.index');

    Route::get('/sales/record', [SalesController::class, 'create'])
        ->name('sales.record');

    Route::post('/sales/store', [SalesController::class, 'store'])
        ->name('sales.store');

    Route::get('/sales/sizes/load/{typeId}', [SalesController::class, 'loadSizes'])
        ->name('sales.sizes.load');

    Route::get('/sales/reports', [SalesController::class, 'reports'])
        ->name('sales.reports');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Salary Management
    Route::get('/salary', [SalaryController::class, 'index'])
        ->name('admin.salary.index');

    Route::post('/salary', [SalaryController::class, 'store'])
        ->name('admin.salary.store');

    Route::get('/salary/{id}/edit', [SalaryController::class, 'edit'])
        ->name('admin.salary.edit');

    Route::post('/salary/{id}', [SalaryController::class, 'update'])
        ->name('admin.salary.update');

    // Payroll
    Route::get('/payroll', [PayrollController::class, 'index'])
        ->name('admin.payroll.index');

    // Amount Received Report
    Route::get('/amount-received', [ReportController::class, 'amountReceived'])
        ->name('admin.amount.received');

    // Salary Advance Edit (admin)
    Route::get('/advance/{id}/edit', [\App\Http\Controllers\Admin\SalaryAdvanceController::class, 'edit'])
        ->name('admin.advance.edit');

    Route::post('/advance/{id}/update', [\App\Http\Controllers\Admin\SalaryAdvanceController::class, 'update'])
        ->name('admin.advance.update');

    // Production Report
    Route::get('/production-report', [ProductionReportController::class, 'index'])
        ->name('admin.production.report');

    // Sales Report
    Route::get('/sales-report', [SalesReportController::class, 'salesReport'])
        ->name('admin.sales.report');
Route::get('/public-dashboard', function () {
    return view('public-dashboard');
})->name('public.dashboard');


        });
