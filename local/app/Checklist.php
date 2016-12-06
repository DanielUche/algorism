<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
 	protected $table = "check_lists";
    
    protected $fillable = [
       'description','name', 'board_id','user_id',"card_id","list_id"
    ];

    public static $rules = ['name'=>'bail|required'];


    public function user() { return $this->belongsTo('App\User','user_id', 'id'); }
    public function board() { return $this->belongsTo('App\Board','board_id', 'id'); }
    public function card() { return $this->belongsTo('App\Card', 'card_id', 'id'); }
    public function boardlist() { return $this->belongsTo('App\BoardList', 'list_id', 'id'); }


    static function getChecks($id){
        return Checklist::where('card_id',$id)->get();
    }

    static function createCheck($request,$id){
        $request->merge(array('user_id'=>$id));
        return Checklist::create($request->all());
    }
}
