<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['user_id', 'content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function field(){
        return $this->belongsTo(Field::class);
    }
}
