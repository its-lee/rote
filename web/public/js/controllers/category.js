angular.module('rote').controller('category', ['$scope', '$http', 'CategoryModalService', 
	function($scope, $http, CategoryModalService) {
	
	var rote = new RoteClient($http);
	
	$scope.getCategories = function() {
		rote.getCategories({}, function(err, response) {
			$scope.categories = err ? [] : response.data;
		});
	}
	
	$scope.deleteCategory = function(category) {
		rote.deleteCategory({ id: category.id }, function(err, response) {
			if (err) return;
			
			$scope.categories = _.reject($scope.categories, function(c) { return c.id === category.id; });
		});
	}
	
	$scope.editCategory = function(category) {
		
		CategoryModalService.showModal({}, {
			name: category.name,
			description: category.description
		}).then(function(result) {
			rote.updateCategory({
				id: category.id,
				name: result.name,
				description: result.description
			}, function(err, response) {
				if (err) return; 
				
				var c = _.find($scope.categories, function(c) { return c.id === category.id });
				if (!c) return;
				
				c.name = result.name;
				c.description = result.description;
			});
		});
	}
	
	$scope.addCategory = function() {
		
		CategoryModalService.showModal({}, {})
		.then(function(result) {
			rote.addCategory({
				name: result.name,
				description: result.description
			}, function(err, response) {
				if (err) return;
				
				$scope.categories.push({
					id: response.data[0].id,
					name: result.name,
					description: result.description
				});
			});
		});
	}
	
	$scope.categories = [];
	$scope.getCategories();
}]);