<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {


        // Pass the $employee data to your view
        return view('dashboard');

    }
}
