angular.module('rote').service('categoryService', ['$http', function ($http) {
	
	var self = this;
	
	// Note : Do not reassign to this collection - since other entities hold references to it.
	// Instead use mutator methods on it!
	self.categories = [];
	
	var rote = new RoteClient($http);
	
	self.update = function(category) {
		rote.updateCategory({
			id: category.id,
			name: category.name,
			description: category.description
		}, function(err, response) {
			if (err) return;
			
			var r = response.data[0];
			
			var c = _.find(self.categories, function(c) { return c.id === r.id });
			if (!c) return;
			
			c.name = r.name;
			c.description = r.description;
			c.when_created = r.when_created;
			c.when_updated = r.when_updated;
		});
	}
	
	self.add = function(category, cb) {
		rote.addCategory({
			name: category.name,
			description: category.description
		}, function(err, response) {
			if (err) return;
			self.categories.push(response.data[0]);
		});
	}
	
	self.delete = function(id) {
		rote.deleteCategory({ id: id }, function(err, response) {
			if (err) return;
			var deleteIdx = _.findIndex(self.categories, function(c) { return c.id === id; });
			if (deleteIdx >= 0)
				self.categories.splice(deleteIdx, 1);
		});
	}
	
	rote.getCategories({}, function(err, response) {
		Array.prototype.push.apply(self.categories, err ? [] : response.data);
	});
}]);