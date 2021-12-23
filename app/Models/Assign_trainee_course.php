<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_trainee_course extends Model
{
    use HasFactory;
    
    protected $table = "assign_trainee_courses";

    protected $fillable = [
        'user_id',
        'course_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Courses::class);
    }

}
