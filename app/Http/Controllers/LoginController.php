<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginAdmin()
    {
        return view('admin.login');
    }

    public function authentication(Request $request)
    {
        $validate =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        if (!Auth::attempt($validate)) {
            return back()->with('alert', 'Email ou senha inválida, verifique os dados!');
        }

        $request->session()->regenerate();
        $user = User::where('email', $request->email)->first();

        return $user->is_admin = 1 ? redirect()->route('admin.home') : redirect()->route('test');
    }
}
