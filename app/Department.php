<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name_id', 'note'];

    public function users(){
        return $this->hasManyThrough(User::class, Employee::class);
    }

    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function departmentName(){
        return $this->belongsTo(Department_name::class);
    }

    public function name(){
        return $this->departmentName->name;
    }

    public function fields(){
        return $this->hasManyThrough(Field::class, Employee::class);
    }
}
