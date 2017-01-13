angular.module('rote').controller('category', ['$scope', '$http', 'modalService', 
	function($scope, $http, modalService) {
	
	var rote = new RoteClient($http);
	
	const modalTemplateUrl = '/../../partials/category-modal.html';
	
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
		
		modalService.showModal({
			templateUrl: modalTemplateUrl
		}, {
			name: category.name,
			description: category.description
		}).then(function(result) {
			rote.updateCategory({
				id: category.id,
				name: result.name,
				description: result.description
			}, function(err, response) {
				if (err) return; 
				
				var r = response.data[0];
				
				var c = _.find($scope.categories, function(c) { return c.id === r.id });
				if (!c) return;
				
				c.name = r.name;
				c.description = r.description;
				c.when_created = r.when_created;
				c.when_updated = r.when_updated;
			});
		});
	}
	
	$scope.addCategory = function() {
		
		modalService.showModal({
			templateUrl: modalTemplateUrl
		}, {})
		.then(function(result) {
			rote.addCategory({
				name: result.name,
				description: result.description
			}, function(err, response) {
				if (err) return;
				$scope.categories.push(response.data[0]);
			});
		});
	}
	
	$scope.categories = [];
	$scope.getCategories();
}]);