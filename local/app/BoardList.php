<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
	protected $table = "lists";
    
    protected $fillable = [
       'description','name', 'board_id','user_id','done'
    ];

    public static $rules = ['name'=>'bail|required'];


    public function user() { return $this->belongsTo('App\User','user_id', 'id'); }
    public function board() { return $this->belongsTo('App\Board','board_id', 'id'); }
    public function cards() { return $this->hasMany('App\Card', 'list_id', 'id'); }

    static function getLists($id){
        return BoardList::where('board_id',$id)->with(['cards'])->get();
    }

    static function createList($request,$id){
        $request->merge(array('user_id'=>$id));
        return BoardList::create($request->all());
    }
}
