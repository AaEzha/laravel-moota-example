<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MootaWebhook extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'body' => 'array',
        'processed' => 'array',
        'processed_at' => 'datetime',
    ];
}
