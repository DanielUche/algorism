<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Board extends Model
{
    use Sluggable;
  
    protected $fillable = [
       'description','name', 'slug','user_id'
    ];

    public function sluggable(){
        return [
            'slug' =>[
            'source' => 'name',
            'separator' => '-'
            ]
        ];
    }

    public static $rules = ['name'=>'bail|required'];

    public function lists() { return $this->hasMany('App\BoardList', 'board_id', 'id'); }

    public function cards() { return $this->hasMany('App\Card', 'board_id', 'id'); }

    public function members() { return $this->hasMany('App\BoardUser', 'board_id', 'id'); }

    public function user() { return $this->belongsTo('App\User','user_id', 'id'); }



    static function getBoards($user){
        return Board::where('user_id',$user)->get();
    }

    static function getId($slug){
        return Board::where('slug',$slug)->first()->id;
    }

    static function getBoardsbySlug($slug){
        return Board::where('slug',$slug)->with(['members','user'])->first();
    }

    public static function createBoard($request,$id){
        $request->merge(array('user_id'=>$id));
        return Board::create($request->all());
    }
}
