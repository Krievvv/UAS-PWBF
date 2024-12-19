<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function indexRegister()
    {
        return view('register');
    }

    public function authenticate(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($data)) {
            return redirect()->back()->with('error', 'Email or Password does not match our records');
        }

            return redirect('/');
    }

    public function create(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => 2,
        ];

        User::create($data);
        return redirect('login')->with('success', 'Account created successfully');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
      }
}
