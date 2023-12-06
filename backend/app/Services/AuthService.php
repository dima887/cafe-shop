<?php

namespace App\Services;

use App\Dto\Auth\AuthLoginDto;
use App\Dto\Auth\AuthRegisterDto;
use App\Exceptions\ClientException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Cookie;

class AuthService
{

    const COOKIE_ONE_DAY = 60 * 24;

    /**
     * New User Registration
     *
     * @param AuthRegisterDto $request
     * @return array
     */
    public function register(AuthRegisterDto $request): array
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('token-name')->plainTextToken;

        $cookie = cookie('token', $token, self::COOKIE_ONE_DAY);

        return ['user' => $user, 'cookie' => $cookie];
    }

    /**
     * User authorization
     *
     * @throws ClientException
     */
    public function login(AuthLoginDto $request): array
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            throw new ClientException('Email or password is incorrect!', 401);
        }

        $token = Auth::user()->createToken('token-name')->plainTextToken;

        $cookie = cookie('token', $token, self::COOKIE_ONE_DAY);

        return ['user' => Auth::user(), 'cookie' => $cookie];
    }

    /**
     * Logout the authenticated user
     *
     * @return Cookie
     */
    public function logout(): Cookie
    {
        Auth::user()->currentAccessToken()->delete();

        return cookie()->forget('token');
    }
}
