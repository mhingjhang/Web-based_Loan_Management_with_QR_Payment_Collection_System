<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Auth;


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
 
        if ($request->hasFile('user_photo')) {
            $file = $request->file('user_photo');
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

    public function showEditAccount(Request $request) {
        // Retrieve the authenticated user's ID
        $userId = Auth::id();

        // Use the user ID to fetch the corresponding Employee data
        $employee = Employee::with('userAccount')->where('UserAccountID', $userId)->first();

        if (!$employee) {
            // Handle the case where no corresponding Employee record is found
            // You can redirect with an error message or handle it as needed.
            return redirect()->route('dashboard')->with('error', 'Employee record not found.');
        }

        // Pass the $employee data to your view
        return view('editAccount', ['employee' => $employee]);
    }

    public function updateAccount(Request $request, $id)
    {
        
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_number' => 'required|string|max:20',
            'position' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|string', // Password is optional
            'confirm_password' => 'nullable|string|same:password', // Confirm password matches password
            'user_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional profile picture update
        ]);

        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Update the employee model with the new data
        $employee->FirstName = $request->input('first_name');
        $employee->MiddleName = $request->input('middle_name');
        $employee->LastName = $request->input('last_name');
        $employee->Email = $request->input('email');
        $employee->ContactNumber = $request->input('contact_number');
        $employee->Position = $request->input('position');

        // Update the user account model (assuming there is a relationship)
        $userAccount = $employee->userAccount;
        $userAccount->UserName = $request->input('username');
        
        // Update the password only if a new one is provided
        if ($request->filled('password')) {
            $userAccount->Password = bcrypt($request->input('password'));
        }


        if ($request->hasFile('user_photo')) {
            $file = $request->file('user_photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);
            $employee->ProfilePicture = $fileName;
        }

        // Save the updated models
        $employee->save();
        $userAccount->save();

        // Redirect to a success page or return a response
        return redirect()->back()->with('success', 'Account updated successfully');
    }

}
