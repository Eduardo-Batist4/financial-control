<?php

namespace App\Services;

use App\Models\Refresh_Token;
use App\Models\User;
use App\Repositories\UserRepositories;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct(protected UserRepositories $userRepositories){}

    public function register(array $request): array
    {
        $user = $this->userRepositories->create($request);

        $token = JWTAuth::fromUser($user);
        $this->createRefreshToken($user);

        return [
            'user' => $user,
            'token' => $token,
            'refresh_token' => $user->refreshToken->jti,
        ];
    }

    public function login(array $request): array | Response
    {
        if (!$token = JWTAuth::attempt($request)) {
            return response()->json([
                'message' => __('auth.failed'),
            ], 401);
        }

        $user = JWTAuth::user();

        $refreshToken = $this->updateRefreshToken($user);

        return [
            'token' => $token,
            'refresh_token' => $refreshToken->jti,
        ];
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return response()->json([
                'message' => 'Token not provided',
            ], 401);
        }

        $user = JWTAuth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
            ], 404);
        }

        JWTAuth::parseToken()->invalidate();

        if ($user->refreshToken) {
            $user->refreshToken->update([
                'is_revoked' => true,
            ]);
        }

        return response()->noContent();
    }

    public function createRefreshToken(User $user): array
    {
        $jti = Str::uuid();
        $expiresAt = now()->addMinutes(config('jwt.refresh_ttl'));

        return Refresh_Token::create([
            'user_id' => $user->id,
            'jti' => $jti,
            'expires_at' => $expiresAt,
            'is_revoked' => false,
        ]);
    }

    public function updateRefreshToken(User $user)
    {
        $jti = Str::uuid();
        $expiresAt = now()->addMinutes(config('jwt.refresh_ttl'));

        $refreshToken = Refresh_Token::where('user_id', $user->id)->first();

        if (!$refreshToken) {
            return response()->json([
                'message' => 'Not found!',
            ], 401);
        }

        $refreshToken->update([
            'jti' => $jti,
            'expires_at' => $expiresAt,
            'is_revoked' => false,
        ]);
        return $refreshToken;
    }

    public function refreshToken($refreshTokenJti): array | Response
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token not provided',
            ], 401);
        }

        $decoded = JWTAuth::getJWTProvider()->decode($token->get());
        $userId = $decoded['sub'];
        $refreshToken = Refresh_Token::where('jti', $refreshTokenJti)
        ->where('user_id', $userId)
        ->first();

        if (!$refreshToken || $refreshToken->isInvalid()) {
            return response()->json([
                'message' => 'Invalid or expired refresh token',
            ], 401);
        }

        $user = $refreshToken->user;

        if (!$user) {
            return response()->json([
                'message' => 'User associated with refresh token not found.',
            ], 401);
        }

        $newAccessToken = JWTAuth::fromUser($user);

        return [
            'token' => $newAccessToken,
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }
}
