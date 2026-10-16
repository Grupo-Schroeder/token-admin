<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\Client;

class Application extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'oauth_client_id',
    ];

    public function oauthClient(): BelongsTo
    {
        return $this->belongsTo(
            Client::class,
            'oauth_client_id',
            'id'
        );
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
