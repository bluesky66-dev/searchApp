var searchApp = angular.module('searchApp', ['ui.router']);

searchApp.config(['$stateProvider','$urlRouterProvider',function($stateProvider, $urlRouterProvider) {
	
	$stateProvider
	.state('adminSearch',{
		url: "/",
		controller: "searchCtrl",
		templateUrl: "views/search.html"
	})
	.state('searchResultBasic', {
		url: '/search_results_basic/{q}/{exactTerms}/{exculdeTerms}/{dateRestrict}/{pageno}/{itemsPerPage}',
		controller: 'searchResultBasic',
		templateUrl: 'views/search_results_basic.html'
	})
	.state('searchResultadvance', {
		url: '/search_results_advance/{q}/{exactTerms}/{exculdeTerms}/{dateRestrict}/{pageno}/{itemsPerPage}',
		controller: 'searchResultAdvance',
		templateUrl: 'views/search_results_advance.html'
	})
	.state('adLogin', {
		url: '/admin',
		controller: 'adminLoginCtrl',
		templateUrl: 'views/admin-login.html'
	})
	.state('otherwise',{
		url: '*path',
		template: '<strong>No route available...................:)</strong>'
	})
}]);