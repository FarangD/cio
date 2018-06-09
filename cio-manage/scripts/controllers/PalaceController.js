angular.module('e-homework').controller('PalaceController', function($scope, $compile, $cookies, $filter, $state, HTTPService, IndexOverlayFactory) {
    IndexOverlayFactory.overlayShow();
    var $user_session = sessionStorage.getItem('user_session');
    
    if($user_session != null){
        $scope.$parent.currentUser = angular.fromJson($user_session);
    }else{
       window.location.replace('#/guest/logon');
    }
    console.log('Hello ! Palace page');
	$scope.DEFAULT_LANGUAGE = 'TH';
    $scope.$parent.menu_selected = 'palace';

    $scope.addFiles = function(){
        $scope.FileList.push({'attachFile':null});
    }

    $scope.load = function(action){
        HTTPService.clientRequest(action, null).then(function(result){
            console.log(result);
            $scope.Palace = null;
            $scope.PalaceList = result.data.DATA.Palace;
            IndexOverlayFactory.overlayHide();
        });
    }

    $scope.edit = function(data){
        $scope.AttachFile = null;
        $scope.Palace = angular.copy(data);
        if($scope.Palace.position_start_date != null && $scope.Palace.position_start_date != undefined && $scope.Palace.position_start_date != ''){
            $scope.Palace.position_start_date = makeDate($scope.Palace.position_start_date);
        }
        if($scope.Palace.position_end_date != null && $scope.Palace.position_end_date != undefined && $scope.Palace.position_end_date != ''){
            $scope.Palace.position_end_date = makeDate($scope.Palace.position_end_date);
        }
        $scope.PAGE = 'UPDATE';
    }

    $scope.cancelUpdate = function(){
        $scope.FileList = [];
        $scope.AttachFile = null;
        $scope.Palace = null;
        $scope.PAGE = 'MAIN';
    }

    $scope.save = function(action, Palace, AttachFile, AttachFileList){
        // console.log($scope.Palace);
        IndexOverlayFactory.overlayShow();
        if(Palace.position_start_date != null && Palace.position_start_date != undefined && Palace.position_start_date != ''){
            Palace.position_start_date = makeSQLDate(Palace.position_start_date);
        }
        if(Palace.position_end_date != null && Palace.position_end_date != undefined && Palace.position_end_date != ''){
            Palace.position_end_date = makeSQLDate(Palace.position_end_date);
        }
       
        var params = {'Palace':Palace, 'AttachFile':AttachFile, 'AttachFileList':AttachFileList};
        HTTPService.uploadRequest(action, params).then(function(result){
            console.log(result);
            $scope.PAGE = 'MAIN';
            if(result.data.STATUS == 'OK'){
                $scope.AttachFile = null;
                $scope.FileList = [];
                $scope.load('palaces');
                $scope.cancelUpdate();
                IndexOverlayFactory.overlayHide();
            }else{
                IndexOverlayFactory.overlayHide();
            }
        });
    }

    $scope.removeAttach = function(action, id, index){
        HTTPService.deleteRequest(action, id).then(function(result){
            // $scope.load('palaces');
            $scope.Palace.AttachFiles.splice(index, 1);
            IndexOverlayFactory.overlayHide();
        });
    }

    $scope.FileList = [];
    $scope.AttachFile = null;
    $scope.Palace = null;
    $scope.popup1 = {
        opened: false
    };

    $scope.popup2 = {
        opened: false
    };

    $scope.open1 = function() {
        $scope.popup1.opened = true;
    };

    $scope.open2 = function() {
        $scope.popup2.opened = true;
    };

    $scope.PAGE = 'MAIN';
    $scope.load('palaces');

});