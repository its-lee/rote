angular.module('rote').controller('category', ['$scope', '$http', 'ModalService', function($scope, $http, ModalService) {
	
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
	
	$scope.editCategory = function(category) {
		var modalOptions = {
			closeButtonText: 'Cancel',
			actionButtonText: 'Edit Category',
			headerText: 'Edit this?',
			bodyText: 'Can you see the words that I am typing with my fingers?'
		};
		
		ModalService.showModal({}, modalOptions).then(function(result) {
			console.log('here');
		});
	}
	
	$scope.categories = [];
	$scope.getCategories();
}]);