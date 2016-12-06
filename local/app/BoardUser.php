<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    protected $table = "board_users";
    
    protected $fillable = [
       'board_id','user_id'
    ];

    public static $rules = ['board_id'=>'bail|required','user_id'=>'bail|required'];


    public function user() { return $this->belongsTo('App\User','user_id', 'id'); }
    public function board() { return $this->belongsTo('App\Board','board_id', 'id'); }

    static function getMembers($id){
        return BoardUser::where('board_id',$id)->with('user')->get();
    }

    static function createMember($request){
        return BoardUser::create($request->all());
    }
}
