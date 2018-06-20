angular.module('e-homework').config(function($routeProvider, $locationProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "views/home.html",
        controller : "HomeController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/HomeController.js" ]
				});
			} ]
		}
	})

	.when("/guest/logon", {
        templateUrl : "views/login.html",
        controller : "LoginController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/LoginController.js" ]
				});
			} ]
		}
	})

	.when("/homework/new_homework", {
        templateUrl : "views/homework/new_homework.html",
        controller : "NewHomeworkController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/NewHomeworkController.js" ]
				});
			} ]
		}
	})

	.when("/about/manage", {
        templateUrl : "views/about/about.html",
        controller : "AboutController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/AboutController.js" ]
				});
			} ]
		}
	})

	.when("/palace/manage", {
        templateUrl : "views/palace/palace.html",
        controller : "PalaceController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/PalaceController.js" ]
				});
			} ]
		}
	})

	.when("/authority/manage", {
        templateUrl : "views/authority/authority.html",
        controller : "AuthorityController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/AuthorityController.js" ]
				});
			} ]
		}
	})

	.when("/policy/manage", {
        templateUrl : "views/policy/policy.html",
        controller : "PolicyController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/PolicyController.js" ]
				});
			} ]
		}
	})

	.when("/project/manage", {
        templateUrl : "views/project/project.html",
        controller : "ProjectController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/ProjectController.js" ]
				});
			} ]
		}
	})

	.when("/docs/manage", {
        templateUrl : "views/update/docs.html",
        controller : "DocsController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/DocsController.js" ]
				});
			} ]
		}
	})

	.when("/contact/manage", {
        templateUrl : "views/contact/contact.html",
        controller : "ContactController",
        resolve : {
			loadMyCtrl : [ '$ocLazyLoad', function($ocLazyLoad) {
				return $ocLazyLoad.load({
					files : [ "scripts/controllers/ContactController.js" ]
				});
			} ]
		}
	})
	;



	$locationProvider.hashPrefix('');
	// $locationProvider.html5Mode({
 //                 enabled: true,
 //                 requireBase: false
 //          });
	
});

/*app.config(function($routeProvider) {
	
	$routeProvider.when('/', {

	  templateUrl: function(rd) {
	    return 'views/home.html';
	  },

	  resolve: {
	    load: function($q, $route, $rootScope) {

	      var deferred = $q.defer();
	      var dependencies = [
	        'scripts/controllers/HomeController.js'
	      ];

	      $script(dependencies, function () {
	        $rootScope.$apply(function() {
	          deferred.resolve();
	        });
	      });

	      console.log(deferred);
	      return deferred.promise;
	    }
	  }
	});

});*/