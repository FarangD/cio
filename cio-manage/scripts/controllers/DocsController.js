angular.module('e-homework').controller('DocsController', function($scope, $compile, $cookies, $filter, $state, $uibModal, HTTPService, IndexOverlayFactory) {
    IndexOverlayFactory.overlayShow();
    var $user_session = sessionStorage.getItem('user_session');
    
    if($user_session != null){
        $scope.$parent.currentUser = angular.fromJson($user_session);
    }else{
       window.location.replace('#/guest/logon');
    }
    console.log('Hello ! Docs page');
    $scope.DEFAULT_LANGUAGE = 'TH';
    $scope.$parent.menu_selected = 'docs';

    $scope.addFiles = function(){
        $scope.FileList.push({'attachFile':null});
    }

    $scope.removeAttach = function(action, id, index){
        HTTPService.deleteRequest(action, id).then(function(result){
            // $scope.load('palaces');
            $scope.Docs.AttachFiles.splice(index, 1);
            IndexOverlayFactory.overlayHide();
        });
    }
    $scope.load = function(action){
        HTTPService.clientRequest(action, null).then(function(result){
            console.log(result);
            $scope.Docs = null;
            $scope.DocsList = result.data.DATA.Docs;
            IndexOverlayFactory.overlayHide();
        });
    }

    $scope.edit = function(data){
        $scope.AttachFile = null;
        $scope.Docs = angular.copy(data);
        $scope.PAGE = 'UPDATE';
    }

    $scope.add = function(){
        $scope.AttachFile = null;
        $scope.Docs = null;
        $scope.PAGE = 'UPDATE';
    }

    $scope.cancelUpdate = function(){
        $scope.AttachFile = null;
        $scope.Docs = null;
        $scope.PAGE = 'MAIN';
    }

    $scope.save = function(action, Docs, AttachFile){
        // console.log($scope.Docs);
        IndexOverlayFactory.overlayShow();
        
        var params = {'DocsObj':Docs, 'AttachFileObj' : AttachFile};
        HTTPService.uploadRequest(action, params).then(function(result){
            console.log(result);
            $scope.PAGE = 'MAIN';
            if(result.data.STATUS == 'OK'){
                $scope.FileList = [];
                $scope.load('docs');
                $scope.cancelUpdate();
                IndexOverlayFactory.overlayHide();
            }else{
                IndexOverlayFactory.overlayHide();
            }
        });
    }

    $scope.remove = function(action, id){
        $scope.alertMessage = 'ต้องการลบข้อมูลนี้ ใช่หรือไม่ ?';
        var modalInstance = $uibModal.open({
            animation : true,
            templateUrl : 'views/dialog_confirm.html',
            size : 'sm',
            scope : $scope,
            backdrop : 'static',
            controller : 'ModalDialogCtrl',
            resolve : {
                params : function() {
                    return {};
                } 
            },
        });

        modalInstance.result.then(function (valResult) {
            IndexOverlayFactory.overlayShow();
            HTTPService.deleteRequest(action, id).then(function(result){
            // $scope.load('Docss');
            $scope.load('docs');
            IndexOverlayFactory.overlayHide();
        });
        });
        
    }

    $scope.FileList = [];
    $scope.Docs = null;

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
    $scope.load('docs');

});