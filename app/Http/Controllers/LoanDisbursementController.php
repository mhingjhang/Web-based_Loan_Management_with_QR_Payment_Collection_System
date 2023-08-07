<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanDisbursementController extends Controller
{
    public function show()
    {
        // your code here
        return view('LoanManagement.loandisbursement');
    }
}
