<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalGroup extends Model
{
    public function students(){
        return $this->hasMany(Student::class);
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }
}
