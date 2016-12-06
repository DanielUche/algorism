<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'email', 'password',
    ];

     public static $rules = ['email'=>'required|email|bail|unique:users', 'username'=>'bail|required' ,'password'=>'bail|required'];

    protected $hidden = [
        'password','remember_token','created_at','updated_at'
    ];
    
    public function boards() { return $this->hasMany('App\Boards', 'user_id', 'id'); }
    
    static function createUser($request){
        $request['password'] = bcrypt($request['password']);
        return User::create($request->all());
    }

    static function getUsers(){
        return User::get();
    }


}
