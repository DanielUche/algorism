<style type="text/css">
.closeBtn{
    cursor: pointer;
    position: absolute;
    z-index: 100;
    margin-top: -30px;  
    right: 0px;
}

</style>
<div class="col-sm-12" >
	<div class="ibox float-e-margins" > 
		<div class="ibox-content">
		<div class="row">
		<a href="#" class="closeBtn" ng-click = "closeModal()">
	          <img src="{{ asset('public/images/close2.png') }}" class="m-b-md" height = "35px" width="35px" />
	      </a>
			<div class ="col-sm-12">
				<p>
					<h2>Trello Mock Users</h2>
				</p>
				<table class="table table-bordered">
					<tr>
						<th>#</th>
						<th>User Name</th>
						<th>Email</th>
						<td>Add</td>
					</tr>
					@foreach($users as $key => $u)
					<tr>
						<td>{{$key+1}} </td>
						<td> {{$u->username }} </td>
						<td>{{$u->email}}</td>
						<td> <form> <input type="checkbox" ng-click = "addMember({{$u->id}})"> </form> </td>
					</tr>
					@endforeach
				</table>	
			</div>
			</div>
		</div>
	</div>
</div>
