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
Route::get('/loanapproval/{id}/Show-Promissory-QRCode', [LoanApprovalController::class, 'showPromissoryQRCode'])->name('show-promissory-qrcode');

Route::get('/loandisbursement', [LoanDisbursementController::class, 'show'])->name('loandisbursement');
Route::post('/disburse/{id}', [LoanDisbursementController::class, 'store'])->name('disburse.store');
Route::post('/addfund', [LoanDisbursementController::class, 'addfund'])->name('addfund');


Route::get('/collection', [CollectionController::class, 'show'])->name('collection');
Route::post('/collection/{id}', [CollectionController::class, 'store'])->name('collection.store');

Route::get('/borrower', [BorrowerController::class, 'show'])->name('borrower');
Route::get('/borrower/{id}', [BorrowerController::class, 'showBorrowerInformation'])->name('showBorrowerInformation');

Route::get('/loaninformation', [LoanInformationController::class, 'show'])->name('loaninformation');
Route::get('/loaninformation/{id}', [LoanInformationController::class, 'showLoanInformation'])->name('showLoanInformation');
Route::get('/paymenthistory/{id}', [LoanInformationController::class, 'showPaymentHistory'])->name('showPaymentHistory');
Route::get('/paymentamortization/{id}', [LoanInformationController::class, 'showPaymentAmortization'])->name('showPaymentAmortization');

Route::get('/repayment', [RepaymentController::class, 'show'])->name('repayment');




