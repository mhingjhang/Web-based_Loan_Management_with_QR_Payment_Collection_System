<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show()
    {
        // your code here
        return view('login');
    }
    public function validate(Request $request, array $rules, array $messages = [], array $attributes = [])
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if ($email === 'admin@loan.com' && $password === 'secret') {
            // Valid email and password
            return view('dashboard');
        } else {
            // Invalid email or password
            return back()->withErrors(['message' => 'Invalid email or password.']);
        }
        
    }
}
