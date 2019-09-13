searchApp.controller('searchCtrl', ['$scope', '$http', '$state', 'searchGoogle', 'AuthenticationService', 'exportGoogleResults', function ($scope, $http, $state, searchGoogle, AuthenticationService, exportGoogleResults) {
    $scope.welcome = "WELCOME TO BMV PROPERTY UK - LISTING CUSTOM SEARCH";

    /********AdmimLoginAuthentication*************/
    var token;
    if (localStorage['token']) {
        token = JSON.parse(localStorage['token']);
    } else {
        token = "something stupid";
    }
    AuthenticationService.checkToken(token);
    /********AdmimLoginAuthentication*************/

    $scope.search = {};

    var pageno = 1;
    $scope.total_count = 0;
    var itemsPerPage = 10;
    var numPages = 0;
    //Function to perform initial search

    $scope.searchGoogle = function () {
        var data = {
            query: $scope.search.query,
            exculdeTerms: $scope.search.exculdeTerms,
            exactTerms: $scope.search.exactTerms,
            dateRestrict: $scope.search.dateRestrict,
            pageno: pageno,
            itemsPerPage: itemsPerPage
        }
        $scope.loading = true;
        var getPostsData = searchGoogle.getResults(data);
        getPostsData.then(function (post) {
            if (post.data.totalResults > 100) {
                $scope.total_count = 100;
            } else {
                $scope.total_count = post.data.totalResults;
            }
            numPages = Math.ceil($scope.total_count / itemsPerPage);
            $scope.number = numPages;
            $scope.getNumber = function (num) {
                return new Array(num);
            }


            $scope.fullObject = post.data;
            //console.log($scope.fullObject);
            $scope.posts = post.data.results;
            $scope.loading = false;
        }, function (error) {
            alert('Error in getting post records');
        });
    }

    //Function inorder to set pagination on google custom search

    $scope.getdata = function (pageno, query, exp) {
        // console.log(pageno);
        var data = {
            query: query,
            exculdeTerms: $scope.search.exculdeTerms,
            exactTerms: $scope.search.exactTerms,
            dateRestrict: $scope.search.dateRestrict,
            pageno: pageno,
            itemsPerPage: itemsPerPage
        }
        $scope.loading = true;
        $scope.posts = {};
        var getPostsData = searchGoogle.getResults(data);
        getPostsData.then(function (post) {
            $scope.fullObject = post.data;

            console.log($scope.fullObject);
            if (exp == 1) {
                Date.prototype.today = function () {
                    return (((this.getMonth() + 1) < 10) ? "0" : "") + (this.getMonth() + 1) + "_" + ((this.getDate() < 10) ? "0" : "") + this.getDate() + "_" + this.getFullYear();
                }

                // For the time now
                Date.prototype.timeNow = function () {
                    return ((this.getHours() < 10) ? "0" : "") + this.getHours() + ":" + ((this.getMinutes() < 10) ? "0" : "") + this.getMinutes() + ":" + ((this.getSeconds() < 10) ? "0" : "") + this.getSeconds();
                }
                var newDate = new Date();
                var datetime = new Date().today() + "_" + new Date().timeNow();
                var getExportStatus = exportGoogleResults.expResults(data);
                getExportStatus.then(function (post) {
                    console.log(post.data);
                    if (post.data = "true") {
                        window.open('/searchApp/rest/newfile.html');
                        // $.ajax({
                        //     url: "/searchApp/rest/newfile.html",
                        //     success: download.bind(true, "text/html", "results" + "_" + datetime + ".html")
                        // });
                    }
                }, function (error) {
                    alert('Error in getting post records');
                });
            }
            if (post.data.totalResults > 100) {
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
    //Function inorder to set pagination on google custom search

    // Admin Logout

    $scope.userLogout = function () {
        var data = {
            token: token
        }
        $http.post("rest/logout.php", data).success(function (res) {
            console.log(res);
            localStorage.clear();
            $state.go("adLogin");
        }).error(function (error) {
            console.log(error);
        })
    }
}]);