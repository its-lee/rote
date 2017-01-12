angular.module('rote').controller("category", function($scope, $http) {
	
	var rote = new RoteClient($http);
	
	$scope.getData = function()
	{
		rote.getCategories(function(err, response) {
			$scope.items = err ? [] : response.data;
		});
	}
	
	$scope.items = [];
	$scope.getData();
});