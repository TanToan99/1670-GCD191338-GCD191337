<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 'admin';
    const ROLE_STAFF = 'staff';
    const ROLE_TRAINER = 'trainer';
    const ROLE_TRAINEE = 'trainee';

    protected $fillable = [
        'name'
    ];
}
