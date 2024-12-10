<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function attendances(){
        return $this->hasMany(Attendance::class);
    }

    public function educationalGroup(){
        return $this->belongsTo(EducationalGroup::class);
    }

}
