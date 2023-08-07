<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function show()
    {
        // your code here
        return view('LoanManagement.borrower');
    }

}
