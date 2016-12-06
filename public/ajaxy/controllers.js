
function signUpCtrl(APP_URL,$scope, $http,$window){
    $scope.signUp = {};
    $scope.plans = {};
    $scope.isProcessing = false;
    $scope.cycles = {};
    $scope.errors = {};


    $scope.signUp = function(formValid){
        
        if(formValid){
            $scope.isProcessing = true;
            $http({url: APP_URL+'register',
                method: "POST",
                data: $.param($scope.signUp),
                headers: {'Content-Type':'application/x-www-form-urlencoded'}
            }).then(function(res){
                if(res.data.errors){     
                    $scope.errors = res.data.errors;
                    if($scope.errors.email){
                        signUpForm['email'].focus();
                    }
                }else if(res.data.success){
                    $window.location = APP_URL + 'welcome';
                }
                $scope.isProcessing = false;
            });
        }
    }
}

function signInCtrl(APP_URL,$scope, $http,$window,toaster){
    $scope.signIn = {};
    $scope.isProcessing=false;

    $scope.signIn = function(formValid){
       if(formValid){
            $scope.isProcessing = true;
            $http({url: APP_URL+'login',
                method: "POST",
                data: $.param($scope.signIn),
                headers: {'Content-Type':'application/x-www-form-urlencoded'}
            }).then(function(res){       
               if(res.data.success){
                    $window.location = res.data.redirectUrl;
                }else{
                    $scope.errors = res.data.msg;
                    toaster.error(res.data.msg);
                }
                $scope.isProcessing = false;
            },function(res){
                toaster.error(res.data.msg);
                $scope.isProcessing = false;
            });
        }
    }
}

function boardCtrl(APP_URL, $http, $scope,toaster){
    $scope.is_create  = false;
    $scope.errors={}; $scope.board={};

    $scope.toggle = function(val){
        if(val ==1){
           $scope.is_create = true; 
       }else{
            $scope.is_create = false; 
       }   
    }

    $scope.saveBoard = function(formvalid){
        if(formvalid){
            $http({
                method:'POST',
                url: APP_URL + "save-board",
                data:$.param($scope.board),
                headers: {'Content-Type':'application/x-www-form-urlencoded'}
            }).then(function(res){
                if(res.data.success){
                    $scope.is_create = false;
                    toaster.success(res.data.success);       
                    $window.location = APP_URL + "boards";
                }else{
                    $scope.errors = res.data.errors;
                }
            },function(){

            });
        }
    }
}

function listCtrl(APP_URL, $http, $scope,toaster,$window,$uibModal){
    $scope.is_create  = false;
    $scope.errors={};
    $scope.members = {};

    $scope.toggle = function(val){
        if(val ==1){
           $scope.is_create = true; 
       }else{
            $scope.is_create = false; 
       }   
    }

    $scope.saveList = function(formvalid){
        if(formvalid){
            $http({
                method:'POST',
                url: APP_URL + "save-list",
                data:$.param($scope.list),
                headers: {'Content-Type':'application/x-www-form-urlencoded'}
            }).then(function(res){
                if(res.data.success){
                    $scope.is_create = false;
                    toaster.success(res.data.success);       
                    location.reload();
                }else{
                    $scope.errors = res.data.errors;
                }
            },function(){

            });
        }
    }

    $scope.saveCard = function(formvalid, model){
        if(formvalid){
            $http({
                method:'POST',
                url: APP_URL + "save-card",
                data:$.param(model),
                headers: {'Content-Type':'application/x-www-form-urlencoded'}
            }).then(function(res){
                if(res.data.success){
                    $scope.is_create = false;
                    toaster.success(res.data.success);     
                    model = {};
                    location.reload();
                }else{
                    $scope.errors = res.data.errors;
                }
            },function(){

            });
        }
    }
    
    $scope.CardForm = function (card,list,boardname) { 
        var modalInstance = $uibModal.open({
            templateUrl: APP_URL+'home/card-element', 
            size:'lg',
            backdrop:"static",keyboard:true,
            scope: $scope,
            controller: cardCtrl,
            resolve: {
                card: function(){ return card; },
                boardname: function(){ return  boardname },
                list: function(){ return  list },
            } 
        }).result.then(function(){ }, function(){ });
    }

    $scope.openMember = function(id){
        var modalInstance = $uibModal.open({
            templateUrl: APP_URL+'members?view=view', 
            size:'lg',
            backdrop:"static",keyboard:true,
            scope: $scope,
            controller: memberCtrl,
            resolve: {
                id:id
            }
        }).result.then(function(){
            location.reload();
        }, function(){ location.reload(); });
    }
}

function memberCtrl(APP_URL,toaster,$scope,$http,$uibModalInstance,id){
    $scope.board_id = id;
    $scope.closeModal = function(){
        $uibModalInstance.dismiss('cancel');
    }

    $scope.addMember = function(user){
        $http({
            method:"post", 
            url: APP_URL+"add-board-member",
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            data: $.param({user_id:user,board_id:id})
        }).then(function(res){
            if(res.data.success){
                toaster.success(res.data.success);
            }else{
                 toaster.error("An error has occured");
            }
        });
    }
}

function cardCtrl(APP_URL,toaster,$scope,$http,$uibModalInstance,card,list,boardname,ModelService){
    $scope.card = card;
    $scope.boardname = boardname;
    $scope.list = list;
    $scope.check = {};
    $scope.checks = {};

    $scope.closeModal = function(){
        $uibModalInstance.dismiss('cancel');
    }

    $http.get(APP_URL+'check-lists/'+$scope.card.id).then(function(res){
        $scope.checks = res.data;
    });

    $scope.saveChecklist = function(formvalid){
         if(formvalid){
            var url = APP_URL + "save-check";
            var p =  ModelService.save($scope.check,url);
            p.then(function(res){
                console.log(res.data.data);
                if(res.data.success) { $scope.check = {}; ModelService.refreshList($scope.checks, res.data.data); }
            },function(){

            });
        }   
    }

    $scope.mark = function(id){
        $http({
            method:"post", 
            url: APP_URL+"done-list",
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            data: $.param({id:id})
        }).then(function(res){
            if(res.data.success){
                toaster.success(res.data.success);
            }else{
                 toaster.error("An error has occured");
            }
        });
    }
}


angular
    .module('trello')
    .controller('signUpCtrl', signUpCtrl)
    .controller('signInCtrl', signInCtrl)
    .controller('boardCtrl',boardCtrl)
    .controller('listCtrl',listCtrl)
    .controller('cardCtrl',cardCtrl)
