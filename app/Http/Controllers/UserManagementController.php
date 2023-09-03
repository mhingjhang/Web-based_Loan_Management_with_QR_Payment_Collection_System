<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;


class UserManagementController extends Controller
{
    public function show(){
        // Retrieve the Employee and related UserAccount data
        $employees = Employee::with('userAccount')->get();


        return view('profile', ['employees' => $employees]);
    
    }

    public function deactivateAccount(Request $request, $id)
    {
        // Find the record by ID
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->back()->with('error', 'User Deactivated unsuccessfully');
        }

        // Update the Status column to 'inactive'
        $employee->update(['Status' => 'Inactive']);

         return redirect()->back()->with('success', 'User Deactivated successfully');
    }
}
