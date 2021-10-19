<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact',
        'cnic',
        'user_id',
        'branch_id',
        'created_by',
    ];


    public function User()
    {
        return $this->belongsTo('User');
    }

    
}
