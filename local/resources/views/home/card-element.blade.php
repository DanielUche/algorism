<style type="text/css">
.closeBtn{
    cursor: pointer;
    position: absolute;
    z-index: 100;
    margin-top: -30px;  
    right: 0px;
}

</style>
<div class="col-lg-12" >

<div>
<div class="ibox float-e-margins" > 

  <div class="ibox-content">
  <div class ="row">
  
    <a href="#" class="closeBtn" ng-click = "closeModal()">
          <img src="{{ asset('public/images/close2.png') }}" class="m-b-md" height = "35px" width="35px" />
      </a>
  </div>
    <div class="row">
    <div class="col-lg-10"><h3>@{{card.name}}  <br/>  <small> in list @{{list.name}}</small>
        <small class="text-navy" style="font-size: 14px;font-weight: bold">   
            <form name = "checkForm" novalidate ng-submit = "saveChecklist(checkForm.$valid)">
                <div class ="form-group" ng-class="{'has-error':checkForm.$submitted && checkForm.name.$invalid}">
                    <input type="checkbox" name="id" ng-model="id" ng-click ="mark(list.id)"> Mark as Done
                </div> 
            </form>
        </small>
    </h3>
        <hr>
        <div class="row">
        <div class="col-lg-12">
            <h2>Check Lists</h2>
        </div>
            <div class = "col-lg-12" class="read" ng-repeat ="a in checks" > 
                <h3> <i class="fa fa-check-square-o"></i>  @{{a.name}} </h3>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <label class="btn btn-block btn-outline btn-success">Member</label>  
        <button type="button" class="btn btn-block btn-outline btn-success">Labels</button> 
        <div class="btn-group dropdown open" uib-dropdown="">
        <button type="button" class="btn btn-success btn-outline  dropdown-toggle btn-block" uib-dropdown-toggle="" aria-haspopup="true" aria-expanded="true">
                Checklist <span class="caret"></span>
            </button>
            <ul role="menu" uib-dropdown-menu="" style="min-width: 270px" class="dropdown-menu">
                <div class="ibox-content">
                     <form name = "checkForm" novalidate ng-submit = "saveChecklist(checkForm.$valid)">
                        <div class ="form-group" ng-class="{'has-error':checkForm.$submitted && checkForm.name.$invalid}">
                            <input type="hidden" name="board_id" ng-model="check.board_id" ng-init="check.board_id = list.board_id">
                            <input type="hidden" name="list_id" ng-model="check.list_id" ng-init="check.list_id = list.id" >
                            <input type="hidden" name="card_id" ng-model="check.card_id" ng-init="check.card_id = card.id" >
                            <input type="text" class="form-control" placeholder="Check List" name="name" ng-model ="check.name" required />
                        </div>
                        <button class="btn btn-sm btn-primary" type="submit">Add</button>    
                    </form> 
                </div>
            </ul>
        </div> 
        <div class="btn-group dropdown open" uib-dropdown="">
        <button type="button" class="btn btn-success btn-outline  dropdown-toggle btn-block" uib-dropdown-toggle="" aria-haspopup="true" aria-expanded="true">
            Due Date <span class="caret"></span>
        </button>
    <ul role="menu" uib-dropdown-menu="" style="min-width: 270px" class="dropdown-menu">
        <div class="ibox-content">
             <form name = "checkForm" novalidate ng-submit = "saveChecklist(checkForm.$valid)">
                <div class ="form-group" ng-class="{'has-error':checkForm.$submitted && checkForm.name.$invalid}">
                    <input type="hidden" name="board_id" ng-model="check.board_id" ng-init="check.board_id = list.board_id">
                    <input type="hidden" name="list_id" ng-model="check.list_id" ng-init="check.list_id = list.id" >
                    <div class="form-group" >
                        <label class="font-noraml">Month select</label>
                        <div class="input-group date">
                          <input type="datetime" class="form-control" date-time ng-model="employee.employment_date" name = "employment_date" view="hours" auto-close="false" min-view="date" format="YYYY-MM-DD" required>
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Add</button>    
            </form> 
        </div>
    </ul>
</div> 
        <button type="button" class="btn btn-block btn-outline btn-success">Attachment</button> 
        <p><h5>Actions</h5></p>
        <button type="button" class="btn btn-block btn-outline btn-success">Move</button> 
        <button type="button" class="btn btn-block btn-outline btn-success">Copy</button>
        <button type="button" class="btn btn-block btn-outline btn-success">Subscribe</button>
        <button type="button" class="btn btn-block btn-outline btn-success">Archive</button>

    </div>

    </div>
    </div>
</div>
</div>




