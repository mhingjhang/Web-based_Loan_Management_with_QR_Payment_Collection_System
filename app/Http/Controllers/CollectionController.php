<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show()
    {
        // your code here
        return view('LoanManagement.collection');
    }
}
