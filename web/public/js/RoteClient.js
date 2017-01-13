
function RoteClient($http)
{
	this.$http = $http;
}

RoteClient.prototype = 
{
	// public:
	
	// params = { id }
	getCategories: function(params, cb) {
		return this.getData("/category", params, cb);
	},
	
	// params = { name, description }
	addCategory: function(params, cb) {
		return this.postData("/category", params, cb);
	},
	
	// params = { id, name, description }
	updateCategory: function(params, cb) {
		console.log(params);
		return this.putData("/category", params, cb);
	},
	
	// params = { id }
	deleteCategory: function(params, cb) {
		return this.deleteData("/category", params, cb);
	},
	
	// params = { id, offset, limit, category_id, title }
	getNotes: function(params, cb) {
		return this.getData("/note", params, cb);
	},
	
	// params = { title, content, category_id }
	addNote: function(params, cb) {
		return this.postData("/note", params, cb);
	},
	
	// params = { id, title, content, category_id }
	updateNote: function(params, cb) {
		return this.putData("/note", params, cb);
	},
	
	// params = { id }
	deleteNote: function(params, cb) {
		return this.deleteData("/note", params, cb);
	},
	
	
	
	
	// private:
	postData: function(path, data, cb) {
		return this.bodyData("POST", path, data, cb);
	},
	
	putData: function(path, data, cb) {
		return this.bodyData("PUT", path, data, cb);
	},
	
	deleteData: function(path, data, cb) {
		return this.bodyData("DELETE", path, data, cb);
	},
	
	bodyData: function(method, path, data, cb)
	{
		return this.$http({
			method: method,
			url: path,
			data: data,
			headers: {
				"Content-Type": "application/json"
			}
		}).then(
		function(response) { cb(null, response); },
		function(response) { cb("error", response); });
	},
	
	getData: function(path, params, cb)
	{
		return this.$http({
			method: "GET",
			url: path,
			params: params
		}).then(
		function(response) { cb(null, response); },
		function(response) { cb("error", response); });
	}
}