<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => config('auth.grant_type.password.client_id'),
            'client_secret' => config('auth.grant_type.password.client_secret'),
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '',
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json([
            'error' => 'Unauthorized',
            'message' => $response->json(),
        ], $response->status());
    }

    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required',
        ]);

        $response = Http::asForm()->post(config('app.url') . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->refresh_token,
            'client_id' => config('auth.grant_type.password.client_id'),
            'client_secret' => config('auth.grant_type.password.client_secret'),
            'scope' => '',
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json([
            'error' => 'Unauthorized',
            'message' => $response->json(),
        ], $response->status());
    }

    // Logout user
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        \DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $token->id)
            ->update(['revoked' => true]);


        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function getUserDetail(Request $request)
    {
        return $request->user();
    }
}
