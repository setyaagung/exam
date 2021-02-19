<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $fillable = ['exam_id', 'question', 'answer', 'option'];
}
