<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('JWT');
            return response()->json($token->plainTextToken, 200);
        }
    
        return response()->json('Usuário não autorizado', 401);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['logout' => true], 200);
    }
}
