<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'email', 'website', 'note', 'longitude', 'latitude'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments(){
        // On creation of clinic, one department (department_name_id:1, name: 'Administration')
        // should be created, user-creator needs to be assigned as employee in it...

        return $this->hasMany(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function employees(){
        return $this->hasManyThrough(Employee::class, Department::class);
    }
}
