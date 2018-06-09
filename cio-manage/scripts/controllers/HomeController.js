angular.module('e-homework').controller('HomeController', function($scope, $cookies, $filter, $state) {
	//console.log('Hello !');
    $scope.DEFAULT_LANGUAGE = 'TH';
    var $user_session = sessionStorage.getItem('user_session');
    
    if($user_session != null){
        $scope.$parent.currentUser = angular.fromJson($user_session);
    }else{
       window.location.replace('#/guest/logon');
    }
});