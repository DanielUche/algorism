
angular
    .module('trello')
    .service('ModelService', function($http, $q) {
        
        Array.prototype.keySort = function(key,desc){
            this.sort(function(a,b){
                var result = desc ? (a[key]< b[key]) : (a[key] > b[key]);
                return result ? 1 : -1;
            }); return this;
        }

    var deferObject,
        myMethods = {
            //Create a db object on server
            save: function(model,saveurl) {
                var promise = $http({
                    method:"POST",
                    url: saveurl,
                    data: $.param(model),
                    headers: {'Content-Type':'application/x-www-form-urlencoded'}
                }), deferObject = deferObject || $q.defer();
                promise.then(function(req){
                deferObject.resolve(req); }, function(reason) {
                    deferObject.reject(reason);
                });
                return deferObject.promise;
            },
            //Get a db object by id
            delete: function(model,data,url){
                var promise =  $http({
                    method:"POST",url:url,
                    data:$.param({model:data.id,employee:data.emp_id}),
                    headers: {'Content-Type':'application/x-www-form-urlencoded'}
                }), deferObject = deferObject || $q.defer();
                promise.then(function(req){
                deferObject.resolve(req); }, function(reason) {
                    deferObject.reject(reason);
                });
                return deferObject.promise;
            },
            removeListItem: function(modellist,id){
                for(var i=0;i<modellist.length;i++){
                    if(modellist[i].id == id) { modellist.splice(i,1); }
                }
            },
            //Get a list of db objects with query
            refreshList: function(modellist, data){
                modellist.push(data);
                modellist.keySort('id',true);
            }
        }

        return myMethods;

});