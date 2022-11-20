<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LbsController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    }

    // public function login(Request $request)
    // {
    //     if (!Auth::attempt([
    //         'email' => $request->email,
    //         'password' => $request->password

    //     ])) {
    //         return response([
    //             'message' => 'invalid Credentials'
    //         ], status: Response::HTTP_UNAUTHORIZED);
    //     };
    //     $user = Auth::user();
    //     // $token = $user->createToken('token')->plainTextToken;
    //     // $cookie = cookie(name: 'jwt', $token, minutes: 60 * 24);
    //     return response()->json([
    //         'message' => 'Login successful',
    //         'data' => [
    //             'user' => $user,
    //             // 'token' => $token
    //         ]
    //     ]);
    // }

    public function user()
    {
        return 'Authenticated user';
    }
}
