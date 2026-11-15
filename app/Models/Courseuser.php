<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course_user extends Model
{
      public function user()
{
    return $this->belongsTo(User::class);
}
public function course()
{
    return $this->belongsTo(courses::class);
}
}
