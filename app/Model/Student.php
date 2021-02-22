<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'name'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
