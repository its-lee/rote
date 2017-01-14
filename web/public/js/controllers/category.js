angular.module('rote').controller('category', ['$scope', '$http', 'modalService', 'categoryService', 
	function($scope, $http, modalService, categoryService) {
	
	const modalTemplateUrl = '/../../partials/category-modal.html';
	
	$scope.deleteCategory = function(category) {
		categoryService.delete(category.id);
	}
	
	$scope.editCategory = function(category) {
		
		modalService.showModal({
			templateUrl: modalTemplateUrl
		}, {
			modalTitle: 'Edit Category',
			id: category.id,
			name: category.name,
			description: category.description
		}).then(function(result) {
			categoryService.update(result);
		});
	}
	
	$scope.addCategory = function() {
		
		modalService.showModal({
			templateUrl: modalTemplateUrl
		}, {
			modalTitle: 'Create Category'
		})
		.then(function(result) {
			categoryService.add(result);
		});
	}
	
	$scope.categories = categoryService.categories;
}]);