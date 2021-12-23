<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_trainer_course extends Model
{
    use HasFactory;

    protected $table = "assign_trainer_courses";

    protected $fillable = ['user_id'];
    
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Courses::class);
    }

}
