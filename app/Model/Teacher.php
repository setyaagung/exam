<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'name', 'group_id', 'course_id'];

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'teacher_groups');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'teacher_courses');
    }
}
