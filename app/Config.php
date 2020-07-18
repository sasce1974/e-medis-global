<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = ['user_id', 'title', 'value', 'note'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
