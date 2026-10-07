<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TokenType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request){
        $status = $request->query('status', 'all');
        $email = trim((string) $request->query('email', ''));
        $name = trim((string) $request->query('name', ''));
        $createdFrom = trim((string) $request->query('created_from', ''));
        $expiresFrom = trim((string) $request->query('expires_from', ''));

        $query = DB::table('oauth_access_tokens')
            ->join('users', 'users.id', '=', 'oauth_access_tokens.user_id')
            ->leftJoin(
                'token_types',
                'token_types.id',
                '=',
                'oauth_access_tokens.token_type_id'
            )
            ->select([
                'oauth_access_tokens.id',
                'oauth_access_tokens.user_id',
                'users.email',
                'oauth_access_tokens.name',
                'token_types.name as token_type_name',
                'oauth_access_tokens.expires_in',
                'oauth_access_tokens.created_at',
                'oauth_access_tokens.expires_at',
                'oauth_access_tokens.revoked',
            ])
            ->orderBy('oauth_access_tokens.created_at', 'desc');

        match ($status) {
            'revoked' => $query->where('oauth_access_tokens.revoked', 1),
            'expired' => $query
                ->where('oauth_access_tokens.revoked', 0)
                ->where('oauth_access_tokens.expires_at', '<', now()),
            'active' => $query
                ->where('oauth_access_tokens.revoked', 0)
                ->where('oauth_access_tokens.expires_at', '>=', now()),
            default => null,
        };

        if ($email !== '') {
            $query->where('users.email', 'like', "%{$email}%");
        }

        if ($name !== '') {
            $query->where('oauth_access_tokens.name', 'like', "%{$name}%");
        }

        if ($createdFrom !== '' && strtotime($createdFrom) !== false) {
            $query->where('oauth_access_tokens.created_at', '>=', $createdFrom);
        }

        if ($expiresFrom !== '' && strtotime($expiresFrom) !== false) {
            $query->where('oauth_access_tokens.expires_at', '>=', $expiresFrom);
        }

        $data = $query->paginate(10)->withQueryString();

        $total = $data->total();

        $users = User::orderBy('name')->get();
        $tokenTypes = TokenType::orderBy('name')->get();

        return view('dashboard.view', [
            'data' => $data,
            'total' => $total,
            'status' => $status,
            'email' => $email,
            'name' => $name,
            'createdFrom' => $createdFrom,
            'expiresFrom' => $expiresFrom,
            'users' => $users,
            'tokenTypes' => $tokenTypes,
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

    public function createToken(){
        $users = User::orderBy('name')->get();

        $tokenTypes = TokenType::orderBy('name')->get();

        return view('tokens.create', [
            'users' => $users,
            'tokenTypes' => $tokenTypes,
        ]);
    }

    public function storeToken(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'token_type_id' => ['required', 'exists:token_types,id'],
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

        // Crear token
        $token = $user->createToken($data['name']);

        // Actualizar información adicional del token
        DB::table('oauth_access_tokens')
            ->where('id', $token->token->id)
            ->update([
                'token_type_id' => $data['token_type_id'],
                'expires_in' => $data['expires_in'],
                'expires_at' => $expiresAt,
            ]);

        $tokenType = TokenType::find($data['token_type_id']);

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
}
