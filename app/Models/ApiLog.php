<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Token;

class ApiLog extends Model
{
    protected $fillable = [
        'token_id',
        'user_id',
        'application_id',
        'method',
        'url',
        'route',
        'status_code',
        'ip_address',
        'user_agent',
        'response_time_ms',
    ];

    protected $casts = [
        'token_id' => 'string',
        'user_id' => 'integer',
        'application_id' => 'string',
        'status_code' => 'integer',
        'response_time_ms' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function token()
    {
        return $this->belongsTo(Token::class, 'token_id');
    }
}
