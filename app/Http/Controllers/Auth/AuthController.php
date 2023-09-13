<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register User
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request): Response
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->assignRole('customer');
        $token = $user->createToken('app')->plainTextToken;

        return response([
            'message' => 'User registered successfully.',
            "user" => $user,
            "token" => $token,
        ], 201);
    }
    /**
     * User login
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request): Response
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $token = $user->createToken('app')->plainTextToken;

            return response([
                "message" => 'User logged in successfully.',
                "user" => $user,
                "token" => $token,
            ]);
        }

        return response([
            "message" => 'Invalid credentials.',
        ], 401);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(): Response
    {
        if (Auth::user()) {
            Auth::user()->tokens()->delete();

            return response([
                "message" => "User logged out successfully.",
            ]);
        }

        return response([
            "message" => "User not authenticated.",
        ], 401);
    }
}
