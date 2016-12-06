@extends('layouts.app')

@section('content')
<div ng-controller = "listCtrl">
<div class="row  border-bottom white-bg dashboard-header ng-scope">
    <div class="col-sm-12">
        <h2 class="ng-binding">{{$board->name}}
        <button class="btn btn-sm btn-default pull-right" ng-click = "openMember({{$board->id}})">Add Members to this Board</button></h2>
        <small class="ng-binding"> <b>Members: </b>
            @foreach($members as $m)
               {{$m->user->username . ', '}}
            @endforeach
        </small> 

    </div>
</div>
<div class ="wrapper wrapper-content animated fadeInRight" >
    <div class = "row">
    
    @foreach($lists as $l)
        <div class="col-lg-3">
            <div class="ibox-content {{ $l->done == 1 ? 'border-green' : '' }}">
                <h5 class="m-b-md">{{$l->name}}
                @if($l->done ==1)
                   <span> <i class="fa fa-check-square-o text-navy fa-2x pull-right"> </i> </span>
                @endif
                </h5>
                @foreach($l->cards as $i)
                    <button type="button" ng-click ="CardForm({{$i}}, {{$l}} ,'{{$board->name}}')" class="btn btn-outline btn-sm btn-block btn-default">{{ $i->name }}</button>
                    <br/>
                @endforeach
                <a class = "openDiv" href="#"> Add a card...</a>
                <div class="computed2">      
                         <form name = "cardForm{{$l->id}} " novalidate ng-submit = "saveCard(cardForm{{$l->id}}.$valid, list{{$l->id}})">
                            <div class ="form-group" ng-class="{'has-error':cardForm{{$l->id}}.$submitted && cardForm{{$l->id}}.name.$invalid}">
                                <input type="hidden" name="board_id" ng-model="list{{$l->id}}.board_id" ng-init="list{{$l->id}}.board_id = {{ $l->board_id}}">
                                <input type="hidden" name="list_id" ng-model="list{{$l->id}}.list_id" ng-init="list{{$l->id}}.list_id = {{ $l->id}}" >
                                <input type="text" class="form-control" placeholder="Card Name" name="name" ng-model ="list{{$l->id}}.name" required />
                            </div>
                            <button class="btn btn-sm btn-default btn-close" type="button" ng-click="toggle(0)">Cancel</button>
                            <button class="btn btn-sm btn-primary" type="submit">Add</button>    
                        </form>  
                    </div>
            </div>
        </div>
       @endforeach
        
        <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-content">
                    <a href="#" ng-click = "toggle(1)" ng-show ="is_create==false"> Create Item</a>
                    <div ng-show ="is_create==true" class="computed">
                        <form name = "listForm" novalidate ng-submit = "saveList(listForm.$valid)">
                            <div class ="form-group" ng-class="{'has-error':listForm.$submitted && listForm.name.$invalid}">
                                <input type="hidden" name="board_id" ng-model="list.board_id" ng-init="list.board_id = {{ $board->id}}" >
                                <input type="text" class="form-control" placeholder="List Name" name="name" ng-model ="list.name" required />
                            </div>
                            <button class="btn btn-sm btn-default" type="button" ng-click="toggle(0)">Cancel</button>
                            <button class="btn btn-sm btn-primary" type="submit">Add</button>    
                        </form>
                    </div>
                </div>
            </div>
        </div>   
    
    </div>
</div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('a.openDiv').click(function(){
            $(this).css({"display":"none"});
            $(this).next('div.computed2').css({"display":"block"});
        });

        $('button.btn-close').click(function(){
            $(this).parents('div.computed2').css({"display":"none"});
            $(this).parents('div.computed2').prev("a.openDiv").css({"display":"block"});
        });
    });
</script>

@endsection


