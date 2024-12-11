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

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

}
