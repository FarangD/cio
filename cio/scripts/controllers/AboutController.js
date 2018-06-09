angular.module('e-homework').controller('AboutController', function($scope, $compile, $cookies, $filter, $state, HTTPService, IndexOverlayFactory) {
    IndexOverlayFactory.overlayShow();
    console.log('Hello ! About page');
	
    console.log($scope.DEFAULT_LANGUAGE);
    $scope.$parent.menu_selected = 'about';
    $scope.$parent.menu_selected_th = 'เกี่ยวกับซีไอโอ';
    $scope.loadAbout = function(action){
        HTTPService.clientRequest(action, null).then(function(result){
            console.log(result);
            $scope.About = result.data.DATA.About;
            
            IndexOverlayFactory.overlayHide();

        });
    }

    $scope.loadPalace = function(action){
        HTTPService.clientRequest(action, null).then(function(result){
            
            $scope.Palace = result.data.DATA.Palace;
            console.log($scope.Palace);
            IndexOverlayFactory.overlayHide();
        });
    }

    $scope.FileList = [];
    $scope.About = {'contents':null};

    $scope.loadAbout('abouts');
    $scope.loadPalace('palaces/current');

});