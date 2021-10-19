<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Counter extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'branch_id',
        'customer_name',
        'customer_number',
        'token_time',
        'token_link',
        'token_price',
        'token_number',
        'status'
    ];

    public function User()
    {
        return $this->belongsTo('User');
    }

    public function Branch()
    {
        return $this->belongsTo('Branch');
    }
}
