searchApp.controller('searchResultBasic',['$scope','$stateParams','searchGoogle',function($scope, $stateParams, searchGoogle){
	 var pageno = 1;
  	$scope.total_count = 0;
  	var itemsPerPage = 10;
  	var numPages = 0;
  	var excludeTerms = "";
        var exactTerms ="";
	var dateRestrict ="";
	var data = {
		query: $stateParams.q,
		exculdeTerms: $stateParams.exculdeTerms,
		exactTerms: $stateParams.exactTerms,
		dateRestrict: $stateParams.dateRestrict,
      		pageno: $stateParams.pageno,
      		itemsPerPage: $stateParams.itemsPerPage
		}
		$scope.loading = true;
     var getPostsData = searchGoogle.getResults(data);
          getPostsData.then(function (post) {   
          if(post.data.totalResults > 100){
            $scope.total_count = 100;
          } else {
            $scope.total_count = post.data.totalResults;
          }
          numPages = Math.ceil($scope.total_count / itemsPerPage);
            $scope.number = numPages;
            $scope.getNumber = function(num) {
              return new Array(num);   
            }

          $scope.fullObject = post.data;
          console.log($scope.fullObject);
          $scope.posts = post.data.results;
          $scope.loading = false;
        }, function (error) {
         alert('Error in getting post records');
        });  

    $scope.getdata = function(pageno, query, excludeTerms, exactTerms, dateRestrict, itemsPerPage){
        console.log(pageno);
        var data = {
          query: query,
          exculdeTerms: excludeTerms,
          exactTerms: exactTerms,
          dateRestrict: dateRestrict,
          pageno: pageno,
          itemsPerPage: itemsPerPage
        }
        $scope.loading = true;
        $scope.posts = {};
         var getPostsData = searchGoogle.getResults(data);
          getPostsData.then(function (post) {
          $scope.fullObject = post.data;
          console.log($scope.fullObject);
          if(post.data.totalResults > 100){
            $scope.total_count = 100;
          } else {
            $scope.total_count = post.data.totalResults;
          }
          $scope.posts = post.data.results;
          $scope.loading = false;
        }, function (error) {
         alert('Error in getting post records');
        });  
      }      

}]);