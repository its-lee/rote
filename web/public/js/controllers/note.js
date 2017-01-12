angular.module('rote').controller("note", function($scope, $http) {
	
	var rote = new RoteClient($http);
	
	$scope.getData = function()
	{
		rote.getNotes(function(err, response) {
			$scope.notes = err ? [] : response.data;
		});
	}
	
	$scope.notes = [];
	$scope.getData();
});