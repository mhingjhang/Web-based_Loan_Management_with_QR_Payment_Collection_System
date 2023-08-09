<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanApprovalController;
use App\Http\Controllers\LoanDisbursementController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\LoanInformationController;
use App\Http\Controllers\RepaymentController;
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
    return view('login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login/validate', [LoginController::class, 'validate'])->name('login.validate');
Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

Route::get('/loanapplication', [LoanApplicationController::class, 'show'])->name('loanapplication');
Route::get('/loanapplication.showLoanInformation', [LoanApplicationController::class, 'showLoan'])->name('showLoan');
Route::get('/loanapplication.showLoanApplicationSummary', [LoanApplicationController::class, 'summary'])->name('summary');
Route::post('/loanapplication.save', [LoanApplicationController::class, 'saveBorrowerandBusinessInformation'])->name('loanapplication.saveBorrowerandBusinessInformation');
Route::post('/loanapplication.save2', [LoanApplicationController::class, 'saveLoanInformation'])->name('loanapplication.saveLoanInformation');
Route::post('/loanapplication.store', [LoanApplicationController::class, 'store'])->name('loanapplication.store');


Route::get('/loanapproval', [LoanApprovalController::class, 'show'])->name('loanapproval');
Route::get('/loanapproval.Show-Promissory-QRCode', [LoanApprovalController::class, 'showPromissoryQRCode'])->name('show-promissory-qrcode');

Route::get('/loandisbursement', [LoanDisbursementController::class, 'show'])->name('loandisbursement');
Route::get('/collection', [CollectionController::class, 'show'])->name('collection');
Route::get('/borrower', [BorrowerController::class, 'show'])->name('borrower');
Route::get('/loaninformation', [LoanInformationController::class, 'show'])->name('loaninformation');
Route::get('/repayment', [RepaymentController::class, 'show'])->name('repayment');




