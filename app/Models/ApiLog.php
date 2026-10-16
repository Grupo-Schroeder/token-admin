<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Token;

class ApiLog extends Model
{
    protected $fillable = [
        'token_id',
        'user_id',
        'method',
        'url',
        'route',
        'status_code',
        'ip_address',
        'user_agent',
        'response_time_ms',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function token()
    {
        return $this->belongsTo(
            Token::class,
            'token_id'
        );

    }
}
