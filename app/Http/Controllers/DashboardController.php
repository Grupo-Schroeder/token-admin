<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use App\Models\TokenType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'tokens');

        /*
        |--------------------------------------------------------------------------
        | TOKENS
        |--------------------------------------------------------------------------
        */

        $status = $request->query('status', 'all');
        $email = trim((string) $request->query('email', ''));
        $name = trim((string) $request->query('name', ''));
        $createdFrom = trim((string) $request->query('created_from', ''));
        $expiresFrom = trim((string) $request->query('expires_from', ''));

        $query = DB::table('oauth_access_tokens')
            ->join(
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
            ->orderBy(
                'oauth_access_tokens.created_at',
                'desc'
            );

        match ($status) {

            'revoked' => $query
                ->where('oauth_access_tokens.revoked', 1),

            'expired' => $query
                ->where('oauth_access_tokens.revoked', 0)
                ->where(
                    'oauth_access_tokens.expires_at',
                    '<',
                    now()
                ),

            'active' => $query
                ->where('oauth_access_tokens.revoked', 0)
                ->where(
                    'oauth_access_tokens.expires_at',
                    '>=',
                    now()
                ),

            default => null,
        };

        if ($email !== '') {
            $query->where(
                'users.email',
                'like',
                "%{$email}%"
            );
        }

        if ($name !== '') {
            $query->where(
                'oauth_access_tokens.name',
                'like',
                "%{$name}%"
            );
        }

        if (
            $createdFrom !== '' &&
            strtotime($createdFrom) !== false
        ) {
            $query->where(
                'oauth_access_tokens.created_at',
                '>=',
                $createdFrom
            );
        }

        if (
            $expiresFrom !== '' &&
            strtotime($expiresFrom) !== false
        ) {
            $query->where(
                'oauth_access_tokens.expires_at',
                '>=',
                $expiresFrom
            );
        }

        $data = $query
            ->paginate(10)
            ->withQueryString();

        $total = $data->total();

        /*
        |--------------------------------------------------------------------------
        | USUARIOS
        |--------------------------------------------------------------------------
        */

        $userSearch = trim(
            (string) $request->query('user_search', '')
        );

        $users = User::query()
            ->when(
                $userSearch !== '',
                function ($query) use ($userSearch) {

                    $query->where(function ($query) use ($userSearch) {

                        $query
                            ->where(
                                'name',
                                'like',
                                "%{$userSearch}%"
                            )
                            ->orWhere(
                                'email',
                                'like',
                                "%{$userSearch}%"
                            );

                    });

                }
            )
            ->withCount('tokens')
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | TOKEN TYPES
        |--------------------------------------------------------------------------
        */

        $tokenTypes = TokenType::orderBy('name')->get();

        /*
        |--------------------------------------------------------------------------
        | LOGS
        |--------------------------------------------------------------------------
        */

        $logs = null;

        if ($tab === 'logs') {
            $logs = ApiLog::query()
                ->with(['user', 'token'])
                ->latest()
                ->paginate(50, ['*'], 'logs_page')
                ->withQueryString();
        }

        /*
        |--------------------------------------------------------------------------
        | APPLICATIONS
        |--------------------------------------------------------------------------
        */

        $applications = null;

        if ($tab === 'applications') {
            $applications = DB::table('applications')
                ->leftJoin(
                    'oauth_clients',
                    'oauth_clients.id',
                    '=',
                    'applications.oauth_client_id'
                )
                ->select([
                    'applications.id',
                    'applications.name',
                    'applications.slug',
                    'applications.description',
                    'applications.status',
                    'applications.oauth_client_id',
                    'applications.created_at',
                    'oauth_clients.name as oauth_client_name',
                    'oauth_clients.revoked as oauth_client_revoked',
                ])
                ->orderBy('applications.name')
                ->paginate(10)
                ->withQueryString();
        }

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard.view', [

            // Navegación
            'tab' => $tab,

            // Tokens
            'data' => $data,
            'total' => $total,
            'status' => $status,
            'email' => $email,
            'name' => $name,
            'createdFrom' => $createdFrom,
            'expiresFrom' => $expiresFrom,

            // Usuarios
            'users' => $users,
            'userSearch' => $userSearch,

            // Tipos de token
            'tokenTypes' => $tokenTypes,
            // Logs
            'logs' => $logs,
            // Aplicaciones
            'applications' => $applications,
        ]);
    }
}
