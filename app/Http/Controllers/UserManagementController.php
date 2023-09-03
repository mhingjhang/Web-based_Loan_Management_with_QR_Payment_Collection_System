<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\UserAccount;


class UserManagementController extends Controller
{
    public function show(){
        // Retrieve the Employee and related UserAccount data
        $employees = Employee::with('userAccount')->get();


        return view('profile', ['employees' => $employees]);
    
    }

    public function showCreateAccount(){
        
        return view('createAccount');
    
    }

    public function createAccount(Request $request)
    {
        $imagePath;
 
        if ($request->hasFile('borrower_photo')) {
            $file = $request->file('borrower_photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $imagePath = $fileName;
        }
                // Create a new UserAccount
        $userAccount = new UserAccount;
        $userAccount->UserName = $request->input('username');
        $userAccount->Password = bcrypt($request->input('password'));
        $userAccount->Status = 'Active';
        $userAccount->DateCreated = now(); // Insert current date and time
        $userAccount->save();

        // Create a new Employee associated with the UserAccount
        $employee = new Employee;
        $employee->FirstName = $request->input('first_name');
        $employee->MiddleName = $request->input('middle_name');
        $employee->LastName = $request->input('last_name');
        $employee->Email = $request->input('email');
        $employee->ContactNumber = $request->input('contact_number');
        $employee->Position = $request->input('position');
        $employee->Status = 'Active';
        $employee->ProfilePicture = $imagePath; // You'll need to define $imagePath
        $employee->UserAccountID = $userAccount->UserAccountID;
        $employee->save();

        // Redirect to a success page or return a response
        return redirect()->back()->with('success', 'User added successfully');
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
