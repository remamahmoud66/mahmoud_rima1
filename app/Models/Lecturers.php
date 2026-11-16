<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecturers extends Model
{
    use SoftDeletes;

    protected $fillable = [
    'user_id',
    'employee_number',
    'department',
    'academic_rank',
    'office_room',
    'photo',
    'is_active',
                           ];

    public function user()
   {
    return $this->belongsTo(User::class);
   }

    public function courses()
{
    return $this->hasMany(courses::class, 'lecturer_id');
}

}
