<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    public function lecturers()
{
    return $this->belongsTo(Lecturers::class, 'cat_id');
}
}
