<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_email',
        'admin_password',
        'admin_name',
    ];

    protected $primaryKey = 'admin_id';

    protected $table = 'admin';
    
}
