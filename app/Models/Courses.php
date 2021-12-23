<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'description',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function trainees()
    {
        return $this->belongsToMany(Assign_trainee_course::class)->withTimestamps();
    }

    public function trainers()
    {
        return $this->belongsToMany(Assign_trainer_course::class)->withTimestamps();
    }
}
