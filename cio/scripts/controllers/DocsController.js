angular.module('e-homework').controller('DocsController', function($scope, $compile, $cookies, $filter, $state, HTTPService, IndexOverlayFactory) {
	
	IndexOverlayFactory.overlayShow();
	
	$scope.$parent.menu_selected = 'docs';
	$scope.$parent.menu_selected_th = 'เอกสารเผยแพร่';
	$scope.loadDocs = function(action){
        HTTPService.clientRequest(action, null).then(function(result){
            console.log(result);
            $scope.Docs = result.data.DATA.Docs;
            IndexOverlayFactory.overlayHide();
        });
    }

    $scope.loadDocs('docs');

});	