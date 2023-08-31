<?php

use App\Http\Controllers\Admin\AccountSettingController;
use App\Http\Controllers\Admin\BorrowerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LoanTypeController;
use App\Http\Controllers\Admin\CreditUnionController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Client\AccountSettingController as ClientAccountSettingController;
use App\Http\Controllers\Client\LoanController as ClientLoanController;
use Illuminate\Support\Facades\Artisan;

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

Route::view('test', 'admin.test');

Route::get('as', [LoginController::class, 'test']);


Route::get('/', function () {
    return view('admin.login');
});

Route::get('check/2stepverification/{admin_id}', [LoginController::class, 'twoStepVerification'])->name('admin.check.2step');
Route::get('check/verification/code/{admin_id}', [LoginController::class, 'checkOTP'])->name('admin.check.verification.code');



/**********************************************************************************
 * <-----------------------------[ADMIN ROUTES]------------------------------------>
 **********************************************************************************/



 /************************************
 * Admin Login & Logout Routes
 ***********************************/

/**
 * login/view
 */
Route::get('login',[LoginController::class , 'loginView'])->name('login.view');

/**
 * login/check
 */
Route::get('login-check',[LoginController::class , 'login'])->name('login');



Route::group(['middleware' => ['admin']], function() {

/**
 * Dashboard
 */
Route::get('dashboard',[LoginController::class , 'dashboard'])->name('dashboard');

/**
 * Dashboard/Loan-Update
 */
Route::post('dashboard/loan-update/{loan_id}',[LoginController::class , 'updateLoanInDashboard'])->name('dashboard.loan.update');

/**
 * logout
 */
Route::get('logout',[LoginController::class , 'logout'])->name('logout');


 /************************************
 * Admin Borrower Routes
 ***********************************/

/**
 * Borrower/show
 */
Route::get('borrowers',[BorrowerController::class , 'index'])->name('borrower.show');

/**
 * Borrower/store
 */
Route::post('borrower/store',[BorrowerController::class , 'store'])->name('borrower.store');

/**
 * Borrower/update
 */
Route::put('borrower/update/{borrower_id}',[BorrowerController::class , 'update'])->name('borrower.update');

/**
 * Borrower/destroy
 */
Route::get('borrower/destroy/{borrower_id}',[BorrowerController::class , 'destroy'])->name('borrower.destroy');



 /************************************
 * Admin LoanType Routes
 ***********************************/

/**
 * LoanType/show
 */
Route::get('loan-type',[LoanTypeController::class , 'index'])->name('loan-type.show');

/**
 * LoanType/store
 */
Route::post('loan-type/store',[LoanTypeController::class , 'store'])->name('loan-type.store');

/**
 * LoanType/update
 */
Route::put('loan-type/update/{loan_type_id}',[LoanTypeController::class , 'update'])->name('loan-type.update');

/**
 * LoanType/destroy
 */
Route::get('loan-type/destroy/{loan_type_id}',[LoanTypeController::class , 'destroy'])->name('loan-type.destroy');






 /************************************
 * Admin CreditUnion Routes
 ***********************************/

/**
 * CreditUnion/show
 */
Route::get('credit-union',[CreditUnionController::class , 'index'])->name('credit-union.show');

/**
 * CreditUnion/store
 */
Route::post('credit-union/store',[CreditUnionController::class , 'store'])->name('credit-union.store');

/**
 * CreditUnion/update
 */
Route::put('credit-union/update/{credit_union_id}',[CreditUnionController::class , 'update'])->name('credit-union.update');

/**
 * CreditUnion/destroy
 */
Route::get('credit-union/destroy/{credit_union_id}',[CreditUnionController::class , 'destroy'])->name('credit-union.destroy');



 /************************************
 * Admin Loan Routes
 ***********************************/

/**
 * Loan/show
 */
Route::get('loan',[LoanController::class , 'index'])->name('loan.show');

/**
 * Loan/add
 */
Route::get('loan/add',[LoanController::class , 'create'])->name('loan.add');

/**
 * Loan/fetch-data/LoanType
 */
Route::post('loan/fetch/loan-type',[LoanController::class , 'fetchDataByAjax'])->name('loan.fetch.data');

/**
 * Loan/store
 */
Route::post('loan/store',[LoanController::class , 'store'])->name('loan.store');

/**
 * Loan/edit
 */
Route::get('loan/edit/{loan_id}',[LoanController::class , 'edit'])->name('loan.edit');

/**
 * Loan/edit/dashboard
 */
Route::get('loan/edit/dashboard/{loan_id}',[LoanController::class , 'dashboardLoanEdit'])->name('loan.edit.dashboard');

/**
 * Loan/update
 */
Route::put('loan/update/{loan_id}',[LoanController::class , 'update'])->name('loan.update');

/**
 * Loan/dashboard/update
 */
Route::put('loan/update/dashboard/{loan_id}',[LoanController::class , 'dashboardLoanUpdate'])->name('loan.update.dashboard');

/**
 * Loan/destroy
 */
Route::get('loan/destroy/{loan_id}',[LoanController::class , 'destroy'])->name('loan.destroy');

/**
 * Loan/changeStatusToArchived
 */
Route::get('loan/status-archived/{loan_id}',[LoanController::class , 'changeStatusToArchived'])->name('loan.change.status.archived');

/**
 * Loan/changeStatusToPending
 */
Route::get('loan/status-pending/{loan_id}',[LoanController::class , 'changeStatusToPending'])->name('loan.change.status.pending');

/**
 * Loan/changeStatusToactive
 */
Route::get('loan/status-active/{loan_id}',[LoanController::class , 'changeStatusToactive'])->name('loan.change.status.active');

/**
 * Loan/Archived
 */
Route::get('archived-loans',[LoanController::class , 'archivedLoan'])->name('loan.archived');

/**
 * Loan/ExportToCSV
 */
Route::get('loan/export-to-csv',[LoanController::class , 'ExportToCSV'])->name('loan.export-to-csv');

/**
 * Loan/ExportToCSV/Individual-Id
 */
Route::get('loan/individual/export-to-csv/{loan_id}',[LoanController::class , 'ExportIndividualIdToCSV'])->name('loan.export-to-csv.individual');


 /************************************
 * Admin User Routes
 ***********************************/

/**
 * User/show
 */
Route::get('user',[UserController::class , 'index'])->name('user.show');

/**
 * User/store
 */
Route::post('user/store',[UserController::class, 'store'])->name('user.store');

/**
 * User/Update
 */
Route::post('user/update/{admin_id}', [UserController::class, 'update'])->name('user.update');

/**
 * User/UpdateImage
 */
Route::post('user/update/image/{admin_id}', [UserController::class, 'updateImage'])->name('user.update.image');

/**
 * User/destroy
 */
Route::get('user/destroy/{admin_id}', [UserController::class, 'destroy'])->name('user.destroy');

 /************************************
 * Admin Account Setting Routes
 ***********************************/

/**
 * Account/Setting/View
 */
Route::get('account-settings',[AccountSettingController::class , 'settingPage'])->name('account.setting.view');

/**
 * Update/Profile
 */
Route::put('update-profile',[AccountSettingController::class , 'updateProfile'])->name('update.profile');

/**
 * Update/Password
 */
Route::put('update-password',[AccountSettingController::class , 'updatePassword'])->name('update.password');

/**
 * Update/Image
 */
Route::post('update-image',[AccountSettingController::class , 'updateImage'])->name('update.image');


Route::get('test', [LoginController::class, 'test']);




/************************************************************************************************* */

 /************************************
 * Client Routes
 ***********************************/

Route::get('client/loans',[ClientLoanController::class , 'index'])->name('client.loans');


 /************************************
 * Admin Account Setting Routes
 ***********************************/

/**
 * Account/Setting/View
 */
Route::get('client/account-settings',[ClientAccountSettingController::class , 'settingPage'])->name('client.account.setting.view');

/**
 * Update/Profile
 */
Route::put('client/update-profile',[ClientAccountSettingController::class , 'updateProfile'])->name('client.update.profile');

/**
 * Update/Password
 */
Route::put('client/update-password',[ClientAccountSettingController::class , 'updatePassword'])->name('client.update.password');

/**
 * Update/Image
 */
Route::post('client/update-image',[ClientAccountSettingController::class , 'updateImage'])->name('client.update.image');

});





Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');



Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});
