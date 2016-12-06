@extends('layouts.app')

@section('content')


<div class ="wrapper wrapper-content animated fadeInRight" ng-controller = "boardCtrl">
    <div class = "row">
       @foreach($boards as $b)
        <div class="col-lg-3">
           <a href="{{url('board/'.$b->slug)}}"> <div class="ibox">
                <div class="ibox-content">
                    <h5 class="m-b-md">{{$b->name}}</h5>
                    <h2 class="text-navy">
                        <i class="fa fa-play fa-rotate-270"></i> Up
                    </h2>
                    <small>{{$b->slug}}</small>
                </div>
            </div></a>
        </div> 
       @endforeach

 

       <div class="col-lg-3">
                <div class="ibox">
                    <div class="ibox-content">
                    <a href="#" ng-click = "toggle(1)" ng-show ="is_create==false"> Create Board</a>
                    <div ng-show ="is_create==true" class="computed">
                        <form name = "boardForm" novalidate ng-submit = "saveBoard(boardForm.$valid)">
                            <div class ="form-group" ng-class="{'has-error':boardForm.$submitted && boardForm.name.$invalid}">
                                <input type="text" class="form-control" placeholder="Board Name" name="name" ng-model ="board.name" required />
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


@endsection


