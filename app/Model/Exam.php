<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['title', 'slug', 'course_id', 'group_id', 'exam_date', 'status', 'duration', 'user_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
