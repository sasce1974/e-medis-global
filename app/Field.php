<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        //'employee_id',
        'start_time',
        'end_time',
        'date',
        'therapy_id',
        'therapist_id',
        'record_id',
        'reserved',
        'note',
        'delete_request'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function record(){
        return $this->hasOne(Record::class);
    }

    public function therapistName($id){
        return User::find($id)->name;
    }
}
