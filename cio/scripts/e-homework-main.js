var serviceUrl = '../CIOService/public/';

var app = angular.module('e-homework', ['ui.bootstrap' , 'ngRoute' , 'ngAnimate', 'ngCookies', 'ui.router', 'oc.lazyLoad', 'ngFileUpload', 'angular-bind-html-compile']);

app.config(function($controllerProvider, $compileProvider, $filterProvider, $provide) {
  app.register = {
    controller: $controllerProvider.register,
    directive: $compileProvider.directive,
    filter: $filterProvider.register,
    factory: $provide.factory,
    service: $provide.service
  };
});

angular.module('e-homework').controller('AppController', ['$cookies','$scope', '$filter', '$uibModal','IndexOverlayFactory', function($cookies, $scope, $filter, $uibModal, IndexOverlayFactory) {
	$scope.overlay = IndexOverlayFactory;
	$scope.overlayShow = false;
	$scope.menu_selected = '';
  

  if(sessionStorage.getItem('DEFAULT_LANGUAGE') == undefined || sessionStorage.getItem('DEFAULT_LANGUAGE') == null || sessionStorage.getItem('DEFAULT_LANGUAGE') == ''){
    sessionStorage.setItem('DEFAULT_LANGUAGE' , 'TH');
  }

  if(sessionStorage.getItem('FONT_SIZE') == undefined || sessionStorage.getItem('FONT_SIZE') == null || sessionStorage.getItem('FONT_SIZE') == ''){
    sessionStorage.setItem('FONT_SIZE' , 1.5);
  }

  $scope.DEFAULT_LANGUAGE = sessionStorage.getItem('DEFAULT_LANGUAGE');
  $scope.FONT_SIZE = sessionStorage.getItem('FONT_SIZE');

  $scope.changeLanguage = function(lang){
    sessionStorage.setItem('DEFAULT_LANGUAGE' , lang);
    // console.log(sessionStorage.getItem('DEFAULT_LANGUAGE'));
    $scope.DEFAULT_LANGUAGE = sessionStorage.getItem('DEFAULT_LANGUAGE');
  }

  $scope.changeFontSize = function(size){
    sessionStorage.setItem('FONT_SIZE' , size);
    $scope.FONT_SIZE = sessionStorage.getItem('FONT_SIZE');
  }

  $scope.newWindows = function(url){
    window.open(url);
  }
    
}]);
