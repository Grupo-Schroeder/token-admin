<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TokenType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function createToken(){
        $users = User::with('tokenType') -> orderBy('name') -> get();


        return view('tokens.create', [ 'users' => $users ]);
    }

    public function storeToken(Request $request) {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'expires_in' => [
                'required',
                'in:15m,30m,1h,5h,1d,5d,20d,1M,1y',
            ],
        ]);

        $expiresAt = match ($data['expires_in']) {
            '15m' => now()->addMinutes(15),
            '30m' => now()->addMinutes(30),
            '1h'  => now()->addHour(),
            '5h'  => now()->addHours(5),
            '1d'  => now()->addDay(),
            '5d'  => now()->addDays(5),
            '20d' => now()->addDays(20),
            '1M'  => now()->addMonth(),
            '1y'  => now()->addYear(),
        };

        $user = User::findOrFail($data['user_id']);
        $tokenType = $user->token_type_id;

        // Crear token
        $token = $user->createToken($data['name']);

        // Actualizar información adicional del token
        DB::table('oauth_access_tokens')
            ->where('id', $token->token->id)
            ->update([
                'token_type_id' => $tokenType,
                'expires_in' => $data['expires_in'],
                'expires_at' => $expiresAt,
            ]);


        // Token que se muestra una sola vez
        $accessToken = $token->accessToken;

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'token' => $accessToken,
                'user' => $user,
                'tokenType' => $tokenType,
                'expiresIn' => $data['expires_in'],
                'expiresAt' => $expiresAt,
            ]);
        }

        return view('tokens.created', [
            'token' => $accessToken,
            'user' => $user,
            'tokenType' => $tokenType,
            'expiresIn' => $data['expires_in'],
            'expiresAt' => $expiresAt,
        ]);
    }

    public function revokeToken($id){
        $token = DB::table('oauth_access_tokens')
        ->where('id', $id)
        ->first();

        if (!$token) {
            abort(404);
        }

        if (\Carbon\Carbon::parse($token->expires_at)->isPast()) {
            return redirect('/dashboard');
        }

        DB::table('oauth_access_tokens')
            ->where('id', $id)
            ->update([
                'revoked' => true,
            ]);

        return redirect('/dashboard');
    }

    public function show($id)
{
    $token = DB::table('oauth_access_tokens')
        ->leftJoin(
            'users',
            'users.id',
            '=',
            'oauth_access_tokens.user_id'
        )
        ->leftJoin(
            'token_types',
            'token_types.id',
            '=',
            'oauth_access_tokens.token_type_id'
        )
        ->where('oauth_access_tokens.id', $id)
        ->select([
            'oauth_access_tokens.id',
            'oauth_access_tokens.name',
            'oauth_access_tokens.expires_in',
            'oauth_access_tokens.created_at',
            'oauth_access_tokens.expires_at',
            'oauth_access_tokens.revoked',
            'users.name as user_name',
            'users.email as user_email',
            'token_types.name as token_type_name',
        ])
        ->first();

    if (!$token) {
        abort(404);
    }

    return view('tokens.show', [
        'token' => $token,
    ]);
}

    public function edit($id)
{
    $token = DB::table('oauth_access_tokens')
        ->leftJoin(
            'users',
            'users.id',
            '=',
            'oauth_access_tokens.user_id'
        )
        ->leftJoin(
            'token_types',
            'token_types.id',
            '=',
            'oauth_access_tokens.token_type_id'
        )
        ->where('oauth_access_tokens.id', $id)
        ->select([
            'oauth_access_tokens.id',
            'oauth_access_tokens.name',
            'oauth_access_tokens.expires_in',
            'oauth_access_tokens.created_at',
            'oauth_access_tokens.expires_at',
            'oauth_access_tokens.revoked',
            'users.name as user_name',
            'users.email as user_email',
            'token_types.name as token_type_name',
        ])
        ->first();

    if (!$token) {
        abort(404);
    }

    return view('tokens.edit', [
        'token' => $token,
    ]);
}


}

