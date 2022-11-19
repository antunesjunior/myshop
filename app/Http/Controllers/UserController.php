<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());

        $input = $request->validate([
            'name' => ['required', 'min:3'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:5']
        ]);

        $input['password'] = Hash::make($request->input('password'));
        User::create($input);

        return redirect()->route('user.login');
    }
}
