<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;

use Illuminate\Http\Request;

use Auth;

use Input;
use App\Card;
use App\User;
use App\Board;
use App\BoardList;
use App\Checklist;
use App\BoardUser;


class HomeController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        //$this->c  =  $request->instance()->query('client_id');
    }

    public function index(Request $request)
    {
        return view('welcome');
    }
    
    public function boards(Request $request)
    {      
        $id = Auth::user()->id;
        $boards = Board::getBoards($id);
        return view('home.dashboard')->with(['boards'=>$boards]);
    }

    public function save_board(Request $request)
    {
        $id = Auth::user()->id;
        if($request->isMethod('post')){
            $validate = Validator::make($request->all(), Board::$rules);
            if($validate->passes()){
                Board::createBoard($request,$id);
                return response()->json(['success'=>'Board Saved Successfully']); 
            }
             return response()->json(['errors'=> $validate->messages()]);
        }
    } 

    public function save_list(Request $request)
    {
        $id = Auth::user()->id;
        if($request->isMethod('post')){
            $validate = Validator::make($request->all(), BoardList::$rules);
            if($validate->passes()){
                BoardList::createList($request,$id);
                return response()->json(['success'=>'List Saved Successfully']); 
            }
             return response()->json(['errors'=> $validate->messages()]);
        }
    } 

    public function save_card(Request $request)
    {
        $id = Auth::user()->id;
        if($request->isMethod('post')){
            $validate = Validator::make($request->all(), Card::$rules);
            if($validate->passes()){
                Card::createCard($request,$id);
                return response()->json(['success'=>'List Saved Successfully']); 
            }
             return response()->json(['errors'=> $validate->messages()]);
        }
    } 

    public function check_lists(Request $request,$id=null){
        return Checklist::getChecks($id);
    }

    public function save_check(Request $request)
    {
        $id = Auth::user()->id;
        if($request->isMethod('post')){
            $validate = Validator::make($request->all(), Checklist::$rules);
            if($validate->passes()){
               $c= Checklist::createCheck($request,$id);
                return response()->json(['success'=>'List Saved Successfully', 'data'=>$c]); 
            }
             return response()->json(['errors'=> $validate->messages()]);
        }
    } 

    public function view_board(Request $request, $slug = null){
        $board = Board::getBoardsbySlug($slug);
        if(!count($board)){
            return redirect('/boards');
        }
        $m = BoardUser::getMembers(Board::getId($slug));
        $lists = BoardList::getLists(Board::getId($slug));
        return view('home.board')->with('members',$m)->with('lists',$lists)->with('board',$board);
    }

    public function card_element(Request $request){
        return view('home.card-element');
    }

    public function members(Request $request){
        $users = User::getUsers();
        return view('home.members')->with(['users'=>$users]);
    }

    public function add_board_member(Request $request){
        if($request->isMethod('post')){
            $validate = Validator::make($request->all(), BoardUser::$rules);
            if($validate->passes()){
                BoardUser::createMember($request);
                return response()->json(['success'=>'Member added to board Successfully']); 
            }
             return response()->json(['errors'=> $validate->messages()]);
        }
    }

    public function done_list(Request $request){
        if($request->isMethod('post')){
              $done= BoardList::findOrFail($request->Input('id'));
              if($done->done ==1){
                    return response()->json(['success'=>'List already marked as completed']); 
              }else{
                $done->done =1;
                $done->save();
                return response()->json(['success'=>'List marked as done board Successfully']); 
              }
        }
    }
}
