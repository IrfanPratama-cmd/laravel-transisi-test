<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');;

//Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'resetPassword']);

Route::post('/login', [AuthController::class, 'postLogin']);
Route::post('/register', [AuthController::class, 'postRegistration']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');

Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/create-roles', [RoleController::class, 'create']);
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('/permissions/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/verify/{token}', [UserController::class, 'verifyAccount'])->name('users.verify');

Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions.index');
Route::post('/divisions', [DivisionController::class, 'store'])->name('divisions.store');
Route::get('/divisions/{id}', [DivisionController::class, 'edit'])->name('divisions.edit');
Route::delete('/divisions/{id}', [DivisionController::class, 'destroy'])->name('divisions.destroy');

Route::get('/positions', [PositionController::class, 'index'])->name('positions.index');
Route::post('/positions', [PositionController::class, 'store'])->name('positions.store');
Route::get('/positions/{id}', [PositionController::class, 'edit'])->name('positions.edit');
Route::delete('/positions/{id}', [PositionController::class, 'destroy'])->name('positions.destroy');

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/create-companies', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{id}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/companies/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');

Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/create-employees', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::get('/get-division-and-position', [EmployeeController::class, 'getDivisionAndPosition']);
Route::get('/employees-pdf', [EmployeeController::class, 'exportPdf']);
Route::get('/employees-pdf/{id}', [EmployeeController::class, 'exportPdfID']);
Route::get('/employees-excel', [EmployeeController::class, 'exportExcel']);
Route::get('/employees-excel/{id}', [EmployeeController::class, 'exportExcelID']);
Route::get('/employees-by/{id}', [EmployeeController::class, 'indexByCompany']);


