<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OAuthIntrospectionController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $token = $request->input('token');

        if (! is_string($token) || $token === '') {
            return response()->json(['active' => false]);
        }

        // Buscar el token por su identificador JWT (claim jti).
        try {
            $parts = explode('.', $token);

            if (count($parts) !== 3) {
                return response()->json(['active' => false]);
            }

            $payload = json_decode(
                base64_decode(strtr($parts[1], '-_', '+/')),
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\Throwable $e) {
            return response()->json(['active' => false]);
        }

        $jti = $payload['jti'] ?? null;

        if (! is_string($jti) || $jti === '') {
            return response()->json(['active' => false]);
        }

        $accessToken = DB::table('oauth_access_tokens')
            ->where('id', $jti)
            ->first();

        if (! $accessToken) {
            return response()->json(['active' => false]);
        }

        $now = now();

        if (
            $accessToken->revoked ||
            ! $accessToken->expires_at ||
            $now->greaterThanOrEqualTo(
                Carbon::parse($accessToken->expires_at)
            )
        ) {
            return response()->json(['active' => false]);
        }

        $client = DB::table('oauth_clients')
            ->where('id', $accessToken->client_id)
            ->first();

        if (! $client || $client->revoked) {
            return response()->json(['active' => false]);
        }

        ApiLog::create([
            'token_id' => (string) $accessToken->id,
            'user_id' => $accessToken->user_id,
            'application_id' => Application::where('oauth_client_id', $accessToken->client_id)->value('id'),
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'route' => $request->path(),
            'status_code' => 200,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'response_time_ms' => 0,
        ]);

        return response()->json([
            'active' => true,
            'client_id' => $accessToken->client_id,
            'sub' => $accessToken->user_id,
            'exp' => Carbon::parse($accessToken->expires_at)->timestamp,
            'scopes' => json_decode($accessToken->scopes ?: '[]', true) ?: [],
        ]);
    }
}
