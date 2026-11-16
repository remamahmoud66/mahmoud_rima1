<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
   public function lecturer()
{
    return $this->belongsTo(Lecturers::class, 'lecturer_id');
}
public function lectures()
{
    return $this->hasMany(Lecture::class, 'course_id');
}

public function users()
{
    return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
        ->withPivot(['enrollment_date', 'grade'])
        ->withTimestamps();
}
}
