<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function school(){
        return $this->belongsTo(School::class)->withDefault();
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }


}
