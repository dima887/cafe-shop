<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="New User Registration",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="SERDTrfygvh!@#123")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User successfully registered.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example="1"),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="email_verified_at", type="timestamp"),
     *             @OA\Property(property="created_at", type="timestamp"),
     *             @OA\Property(property="updated_at", type="timestamp"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param RegisterRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        $auth = $authService->register($request->getDto());

        return response()->json(['user' => $auth['user']])->withCookie($auth['cookie']);
    }


    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User authorization",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@mail.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="User successfully registered.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example="1"),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="email_verified_at", type="timestamp"),
     *             @OA\Property(property="created_at", type="timestamp"),
     *             @OA\Property(property="updated_at", type="timestamp"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Email or password is incorrect!",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Email or password is incorrect!")
     *         )
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param LoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     * @throws ClientException
     */
    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $auth = $authService->login($request->getDto());

        return response()->json(['user' => $auth['user']])->withCookie($auth['cookie']);
    }


    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Logout the authenticated user",
     *     tags={"Authentication"},
     *     @OA\Response(
     *         response="200",
     *         description="User successfully logged out.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Logged out successfully!"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Unauthenticated.",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Oops, there are temporary problems",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Oops, there are temporary problems")
     *         )
     *     ),
     * )
     *
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function logout(AuthService $authService): JsonResponse
    {
        return response()->json([
            'message' => 'Logged out successfully!'
        ])->withCookie($authService->logout());
    }

    public function getAuthUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
}
