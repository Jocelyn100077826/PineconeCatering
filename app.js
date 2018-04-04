/*jslint white:true */
/*global angular */
var app = angular.module("myApp", []);
app.controller("myCtrl", function ($scope) {
	$scope.un = "admin";
	$scope.pw = "pinecone";
	$scope.msg = "";
	
	$scope.check= function(u,p){
		if ($scope.un == u && $scope.pw == p){
			location.href = 'modfood.php';
		}else {
			$scope.msg = "Username or Password Incorrect";
			$scope.uname = "";
			$scope.pword = "";
		}
	}
});