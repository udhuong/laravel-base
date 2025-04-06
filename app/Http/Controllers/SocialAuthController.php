<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'password' => bcrypt(Str::random(16)),
                'email_verified_at' => now(),
            ]
        );

        // Đăng nhập luôn nếu muốn
        Auth::login($user);

        // Hoặc nếu bạn dùng Passport / Sanctum:
        $token = $user->createToken('access_token')->accessToken;

        return response()->json([
            'message' => 'Social login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }
}
