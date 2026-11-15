<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturers extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department',
    ];


    public function user()
   {
    return $this->belongsTo(User::class);
   }

     public function courses()
{
    return $this->hasMany(courses::class, 'cat_id');
}
public function courses_()
{
    return $this->hasMany(Orderitem::class);
}

}
