<?php

namespace App\Http\Controllers;


use App\Models\TokenType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function createUser(){
        $tokenTypes = TokenType::orderBy('name')->get();

        return view('users.create', [
            'tokenTypes' => $tokenTypes,
        ]);
    }

    public function storeUser(Request $request) {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'token_type_id' => ['required', 'exists:token_types,id'],
        ]);

        $clientKey = bin2hex(random_bytes(16));
        $clientSecret = bin2hex(random_bytes(16));

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'token_type_id' => $data['token_type_id'],
            'password' => Str::random(64),
            'client_key' => $clientKey,
            'client_secret' => Hash::make($clientSecret),

        ]);

        return view('users.created', [
            'user' => $user,
            'clientKey' => $clientKey,
            'clientSecret' => $clientSecret,
        ]);

    }

    public function showUser($id) {
        $user = User::findOrFail($id);

        $tokens = DB::table('oauth_access_tokens')
            ->leftJoin(
                'token_types',
                'token_types.id',
                '=',
                'oauth_access_tokens.token_type_id'
            )
            ->where('oauth_access_tokens.user_id', $user->id)
            ->select([
                'oauth_access_tokens.id',
                'oauth_access_tokens.name',
                'token_types.name as token_type_name',
                'oauth_access_tokens.expires_in',
                'oauth_access_tokens.created_at',
                'oauth_access_tokens.expires_at',
                'oauth_access_tokens.revoked',
            ])
            ->orderBy('oauth_access_tokens.created_at', 'desc')
            ->get();

        return view('users.show', [
            'user' => $user,
            'tokens' => $tokens,
        ]);
    }
}
