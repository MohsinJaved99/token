<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $table = "branches";
    protected $primaryKey = "id";
    protected $fillable = [
        'address',
        'contact',
        'user_id',
        'status'
    ];
    public function Counter()
    {
        return $this->hasMany('Counter');
    }
}
