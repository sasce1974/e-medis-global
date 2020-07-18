<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department_name extends Model
{
    protected $fillable = ['name', 'note', 'user_id'];

    public function departments(){
        return $this->hasMany(Department::class);
    }
}
