'use strict';
(function(){
	angular.module('trello',['angular-ladda', 'datePicker',
		'ngResource','toaster', 'ngAnimate' ,'ui.bootstrap'
	]).constant('APP_URL', '/algorism/');
})();