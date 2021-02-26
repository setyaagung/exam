<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    protected $fillable = ['teacher_id', 'course_id'];
}
