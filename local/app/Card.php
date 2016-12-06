<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $table = "cards";
    
    protected $fillable = [
       'description','name', 'board_id','user_id','card_id','list_id'
    ];

    public static $rules = ['name'=>'bail|required'];


    public function user() { return $this->belongsTo('App\User','user_id', 'id'); }
    public function board() { return $this->belongsTo('App\Board','board_id', 'id'); }
    public function boardlist() { return $this->belongsTo('App\BoardList','board_id', 'id'); }
    public function checklists() { return $this->hasMany('App\Checklist', 'card_id', 'id'); }


    static function getCards($id){
        return Card::where('list_id',$id)->get();
    }

    static function createCard($request,$id){
        $request->merge(array('user_id'=>$id));
        return Card::create($request->all());
    }
}
