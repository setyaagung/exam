<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['exam_id', 'user_id', 'true_answer', 'false_answer', 'result_json'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
