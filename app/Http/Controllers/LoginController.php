<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function regist()
    {
        return view('regist');
    }

    public function loginAdmin()
    {
        return view('admin.login');
    }

    public function authUser(Request $request)
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

        return redirect()->route('index.home');
    }


    public function authAdmin(Request $request)
    {
        $validate =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        if (!Auth::attempt($validate)) {
            return back()->with('alert', 'Email ou senha inválida, verifique os dados!');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user->is_admin) {
            return back()->with('alert', 'Nao es um administrador!');
        }

        $request->session()->regenerate();

        return redirect()->route('admin.home', $user);
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('index.home');
    }
}
