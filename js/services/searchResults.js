searchApp.service('searchGoogle', ['$http','$state','$location', function($http, $state, $location){
	this.getResults = function(data){
		var baseUrl = "rest/example.php";
		var completeUrl = baseUrl + "?query="+ data.query 
                     + "&exculdeTerms=" + data.exculdeTerms + "&exactTerms=" + data.exactTerms + "&dateRestrict=" + data.dateRestrict + "&itemsPerPage=" + data.itemsPerPage + "&pageNo=" + data.pageno  //and the same for input 3
 		return	$http({method: 'GET', url: completeUrl});
 //success(function(data, status, headers, config) {
    // here data contains all informations returned by the server
 //}).
 //error(function(data, status, headers, config) {
    //In case your server respond with a 4XX or 5XX error code
 //});
		//return $http.get("rest/example.php", data);
	}
}]);
