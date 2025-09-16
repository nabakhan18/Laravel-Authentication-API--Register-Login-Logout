<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {

        // Manually trim and sanitize email
        $request->merge([
            'email' => trim($request->email),
        ]);

        // Check if user already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'User already registered.'
            ], 409); // 409 = Conflict
        }

        // Validation rules
        $validator = validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/',
            ],
            'password' => 'required|string|min:8',
        ], [
            'email.regex' => 'The email must not contain spaces.',
            'email.email' => 'The email format is invalid.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        // Handle failed validation
        if ($validator->fails()) {
            return response()->json([
                'message' => 'We cant register, correct your format',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully.',
            'user' => $user,
        ], 201);

        if ($user) {
            return redirect()->route('dashboard'); // agar dashboard ka route bana hua hai
        }
    }



    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Check if user exists
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->withErrors(['email' => '❌ User not found']);
        }

        // Verify password
        if (!\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => '❌ Incorrect password']);
        }

        // Generate JWT token
        if (!$token = \Tymon\JWTAuth\Facades\JWTAuth::attempt($credentials)) {
            return back()->withErrors(['email' => '❌ Could not create token']);
        }

        // ✅ Store token in session so we can use it later
        session(['jwt_token' => $token]);

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', '✅ Login successful!');
    }



    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken()); // 🔑 this kills the token
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => 'Token is invalid or already expired'], 401);
        }
    }

    // Refresh token
    public function refresh()
    {
        $newToken = JWTAuth::refresh(JWTAuth::getToken());

        return response()->json([
            'token' => $newToken
        ]);
    }

    // Get current user
    public function me()
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated. Token is missing, invalid, or expired.'
            ], 401); // 401 Unauthorized
        }

        return response()->json($user);
    }
}
