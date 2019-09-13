searchApp.controller('adminLoginCtrl',['$scope', '$state','$http', function($scope, $state, $http){
  $scope.loginInfo = {
    username: undefined,
    password: undefined
  }

  $scope.loginUser = function (){

    var data = {
      username: $scope.loginInfo.username,
      password: $scope.loginInfo.password
    }

    $http.post("rest/login.php", data).success(function(res) {
      //console.log(res);
      localStorage.setItem("token", JSON.stringify(res));
      $state.go("adminSearch");
    }).error(function(error){
      console.log(error);
    });
  } 
}]);