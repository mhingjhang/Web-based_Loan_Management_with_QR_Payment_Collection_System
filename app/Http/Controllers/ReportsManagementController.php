<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanApplication;
use PDF;


class ReportsManagementController extends Controller
{
    public function showLoanApplicationReport(){

        $loanApplications = LoanApplication::with('client', 'client.clientBusiness')->get();

        // Total number of loan applications
        $totalLoanApplications = LoanApplication::count();

        // Count of loan applications with Approved status
        $approvedLoanApplications = LoanApplication::where('Status', 'Approved')->count();

        // Count of loan applications with Rejected status
        $rejectedLoanApplications = LoanApplication::where('Status', 'Rejected')->count();

        // Sum of the Principal column
        $totalPrincipal = LoanApplication::sum('Principal');


        return view('ReportsManagement.loanApplicationReport', [
            'loanApplications' => $loanApplications,
            'totalLoanApplications' => $totalLoanApplications,
            'approvedLoanApplications' => $approvedLoanApplications,
            'rejectedLoanApplications' => $rejectedLoanApplications,
            'totalPrincipal' => $totalPrincipal,
        ]);
    }
    public function printPreviewLoanApplicationReport(){
     
    }


     public function filterLoanApplications(Request $request)
     {
          $selectedOption = $request->query('selectedOption');
          $filterValue = $request->query('filterValue');

          $filteredData = ' ';
          $totalLoanApplications = '';
          $approvedLoanApplications = '';
          $rejectedLoanApplications = "";
          $totalPrincipal = '';


          if ($selectedOption === 'daily') {
               // Daily query
               $filteredData = LoanApplication::with('client', 'client.clientBusiness')
                    ->where('ApplicationDate', $filterValue)
                    ->get();

               // Total number of loan applications
               $totalLoanApplications = LoanApplication::where('ApplicationDate', $filterValue)->count();

               // Count of loan applications with Approved status
               $approvedLoanApplications = LoanApplication::where('Status', 'Approved')->where('ApplicationDate', $filterValue)->count();

               // Count of loan applications with Rejected status
               $rejectedLoanApplications = LoanApplication::where('Status', 'Rejected')->where('ApplicationDate', $filterValue)->count();

               // Sum of the Principal column
               $totalPrincipal = LoanApplication::where('ApplicationDate', $filterValue)->sum('Principal');

          } elseif ($selectedOption === 'weekly') {
               // Week query
               // Extract the year and week from $filterValue and run the query accordingly
               // Debugging
               $year = substr($filterValue, 0, 4);
               $week = substr($filterValue, 6);

               $filteredData = LoanApplication::with('client', 'client.clientBusiness')
                    ->whereRaw("YEAR(ApplicationDate) = ? AND WEEK(ApplicationDate, 2) = ?", [$year, $week])
                    ->get();

               $totalLoanApplications = LoanApplication::whereRaw("YEAR(ApplicationDate) = ? AND WEEK(ApplicationDate, 2) = ?", [$year, $week])->count();

               // Count of loan applications with Approved status
               $approvedLoanApplications = LoanApplication::where('Status', 'Approved')
                    ->whereRaw("YEAR(ApplicationDate) = ? AND WEEK(ApplicationDate, 2) = ?", [$year, $week])
                    ->count();

               // Count of loan applications with Rejected status
               $rejectedLoanApplications = LoanApplication::where('Status', 'Rejected')
                    ->whereRaw("YEAR(ApplicationDate) = ? AND WEEK(ApplicationDate, 2) = ?", [$year, $week])
                    ->count();

               // Sum of the Principal column
               $totalPrincipal = LoanApplication::whereRaw("YEAR(ApplicationDate) = ? AND WEEK(ApplicationDate, 2) = ?", [$year, $week])->sum('Principal');
          }
          elseif ($selectedOption === 'monthly') {

               $year = substr($filterValue, 0, 4);  // Extract the year (e.g., "2023")
               $month = substr($filterValue, 5, 2); // Extract the month (e.g., "09")

               $filteredData = LoanApplication::with('client', 'client.clientBusiness')
               ->whereRaw("YEAR(ApplicationDate) = ? AND MONTH(ApplicationDate) = ?", [$year, $month])
               ->get();

               $totalLoanApplications = LoanApplication::whereRaw("YEAR(ApplicationDate) = ? AND MONTH(ApplicationDate) = ?", [$year, $month])->count();

               // Count of loan applications with Approved status
               $approvedLoanApplications = LoanApplication::where('Status', 'Approved')
                    ->whereRaw("YEAR(ApplicationDate) = ? AND MONTH(ApplicationDate) = ?", [$year, $month])
                    ->count();

               // Count of loan applications with Rejected status
               $rejectedLoanApplications = LoanApplication::where('Status', 'Rejected')
                    ->whereRaw("YEAR(ApplicationDate) = ? AND MONTH(ApplicationDate) = ?", [$year, $month])
                    ->count();

               // Sum of the Principal column
               $totalPrincipal = LoanApplication::whereRaw("YEAR(ApplicationDate) = ? AND MONTH(ApplicationDate) = ?", [$year, $month])->sum('Principal');

          }
          elseif ($selectedOption === 'yearly') {


               $filteredData = LoanApplication::with('client', 'client.clientBusiness')
               ->whereRaw("YEAR(ApplicationDate) = ?", [$filterValue])
               ->get();

               $totalLoanApplications = LoanApplication::whereRaw("YEAR(ApplicationDate) = ?", [$filterValue])->count();

               // Count of loan applications with Approved status
               $approvedLoanApplications = LoanApplication::where('Status', 'Approved')
                    ->whereRaw("YEAR(ApplicationDate) = ?", [$filterValue])
                    ->count();

               // Count of loan applications with Rejected status
               $rejectedLoanApplications = LoanApplication::where('Status', 'Rejected')
                    ->whereRaw("YEAR(ApplicationDate) = ?", [$filterValue])
                    ->count();

               // Sum of the Principal column
               $totalPrincipal = LoanApplication::whereRaw("YEAR(ApplicationDate) = ?", [$filterValue])->sum('Principal');

               

          }
          

          return response()->json([
               'filteredData' => $filteredData, 
               'totalLoanApplications' => $totalLoanApplications, 
               'approvedLoanApplications' => $approvedLoanApplications,
               'rejectedLoanApplications' => $rejectedLoanApplications,
               'totalPrincipal' => $totalPrincipal
          ]);
     }

    public function showOutstandingBalanceReport(){
         return view('ReportsManagement.outstandingBalanceReport');
    }

    public function showLoanPortfolioReport(){
         return view('ReportsManagement.loanPortfolioReport');
    }

    public function showDelinquencyReport(){
         return view('ReportsManagement.delinquencyReport');
    }

    public function showDisbursementReport(){
         return view('ReportsManagement.disbursementReport');
    }

    public function showCollectorsReport(){
         return view('ReportsManagement.collectorsReport');
    }

    public function showGrossIncomeReport(){
         return view('ReportsManagement.grossIncomeReport');
    }
}
