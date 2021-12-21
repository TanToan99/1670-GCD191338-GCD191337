<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function courses(): belongsToMany
    {
        return $this->belongsToMany(Courses::class)->withTimestamps();
    }
}
