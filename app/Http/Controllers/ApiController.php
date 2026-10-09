<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

    public function login(Request $request)
    {

        if (
            !$request->filled('client_key') ||
                !$request->filled('client_secret')
        ) {
            return response()->json([
                'message' => 'Credenciales inválidas.',
            ], 401);
        }

        $user = User::where(
            'client_key',
            $request->input('client_key')
        )->first();

        if (
            !$user ||
                !$user->client_secret ||
                !Hash::check(
                    $request->input('client_secret'),
                    $user->client_secret
                )
        ) {
            return response()->json([
                'message' => 'Credenciales inválidas.',
            ], 401);
        }

        $expiresAt = now()->addMinutes(30);

        $tokenResult = $user->createToken('API Login');

        DB::table('oauth_access_tokens')
            ->where('id', $tokenResult->token->id)
            ->update([
                'token_type_id' => $user->token_type_id,
                'expires_in' => '30m',
                'expires_at' => $expiresAt,
            ]);

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'expires_in' => (string) max(
                0,
                $expiresAt->diffInSeconds(now(), false)
            ),
            'token_type' => 'BearerToken',
            'email' => $user->email,
        ]);
    }
}

