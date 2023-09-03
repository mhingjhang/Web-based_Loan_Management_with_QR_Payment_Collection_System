<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        // your code here
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['UserName' => $request->username, 'password' => $request->password])) {
            $user = Auth::user(); // Get the authenticated user
            $userId = $user->id;

            $request->session()->put('userId', $userId);
            // Authentication was successful
            return redirect()->route('dashboard'); // Redirect to the intended URL after login
        } else {
            // Authentication failed
            return redirect()->route('login')->with('error', 'Invalid login credentials');
        }


    }

    // Logout the user
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login'); // Redirect to the login page
    }
}
