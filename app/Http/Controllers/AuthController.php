<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $response = Http::post(env('ISSUE_AUTH_LOGIN'), [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $response->json('token');

        return response()->json([
            'status' => 'success',
            'data' => [
                'token' => $token,
            ]
        ]);
    }

    public function getProfile(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Token tidak ditemukan.'
            ], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->get(env('ISSUE_PROFILE'));

        if ($response->failed()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        if ($response->json('status') === 'User not authenticated') {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized: Token tidak valid atau telah kedaluwarsa.'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'data' => $response->json()
        ]);
    }
}
