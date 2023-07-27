<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'logins';

    protected $fillable = [
        'user_id',
        'verification_code',
        'renovation_date',
        'verification_code_issue_date',
        'verification_code_expiration_date',
        'last_login_date',
        'active'
    ];

    protected $hidden = [
        'verification_code',
    ];
}
