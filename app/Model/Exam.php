<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['title', 'slug', 'course_id', 'group_id', 'exam_date', 'status'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
