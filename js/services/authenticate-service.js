searchApp.service('AuthenticationService', ["$http", "$state", function($http, $state){
	var self = this;
	self.checkToken = function (token){
		var data = {
			token: token
		}
		$http.post('rest/checkToken.php', data).success(function(res){
			//console.log(res);
			if(res === 'unauthorized'){
				console.log(res);
				$(".loginAppError").append("<b>Either Username or Password is Incorrect!</b>");
				$state.go("adLogin");
			} else {
				console.log(res);
				return res;
			}
		}).error(function(error){
			$state.go("login")
		});
	}
}]);