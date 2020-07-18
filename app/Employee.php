<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        //'department_id',
        'role',
        'employed_at',
        'employed_to',
        'admin_level',
        'active'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function fields(){
        return $this->hasMany(Field::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function clinic(){

        return $this->department->clinic();

        //return $this->belongsTo(Clinic::class);
    }
}
