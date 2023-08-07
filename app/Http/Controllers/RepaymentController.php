<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    public function show()
    {
        // your code here
        return view('LoanManagement.repayment');
    }
}
