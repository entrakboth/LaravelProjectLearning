<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAcc extends Model
{
    use HasFactory;

    protected $table = 'user_acc';

    protected $fillable = [
        'Name',
        'UserTimePost',
        'UserProfile',
        'UserPostImages',
    ];

    protected $casts = [
        'UserTimePost' => 'datetime',
    ];
}
