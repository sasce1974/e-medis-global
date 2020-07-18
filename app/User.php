<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

//use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'address', 'phone', 'birth_date', 'note'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*public function role($user_id = null){
        $user_id === null ? $user = Auth::user() : $user = User::findOrFail($user_id);
        $role = Role::find($user_id);
        return $role ? $role->name : "Undefined"; //$this->hasOne('App\Role');
    }*/

    public function role(){
        return $this->belongsTo(Role::class);
    }

    /*public function fields(){
        return $this->hasMany(App\Field::class);
    }*/

    public function records(){
        return $this->hasMany(Record::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function clinic(){
        return $this->hasMany(Clinic::class);
    }

    public function getClinicNameAttribute(){
        $clinics = array();
        foreach ($this->clinic as $clinic){
            $clinics[] = $clinic->name;
        }
        $clinics = implode(', ', $clinics);
        return $clinics;
    }

    public function employee(){
        return $this->hasOne(Employee::class);
    }

    public function config(){
        return $this->hasMany(Config::class);
    }

    public function avatar($size = null){
        $email = $this->email;
        //$default = "https://www.somewhere.com/homestar.jpg";
        if($size === null) $size = 32;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;

    }

    public function getAgeAttribute(){
        $date_born = $this->birth_date;
        return Carbon::parse($date_born)->age;
    }

    public function isAdmin(){
        return $this->role->name === "Administrator" ? true : false;
    }
}
