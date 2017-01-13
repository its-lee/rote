angular.module('rote').controller("category", function($scope, $http) {
	
	var rote = new RoteClient($http);
	
	$scope.getCategories = function() {
		rote.getCategories({}, function(err, response) {
			$scope.categories = err ? [] : response.data;
		});
	}
	
	$scope.deleteCategory = function(category) {
		rote.deleteCategory({ id: category.id }, function(err, response) {
			if (!err)
				$scope.categories = _.reject($scope.categories, function(c) { return c.id === category.id; });
		});
	}
	
	$scope.categories = [];
	$scope.getCategories();
});