angular.module('rote').service('roteService', ['$http', function ($http) {
    
    // private:
    
    function bodyData(method, path, data, cb)
    {
        return $http({
            method: method,
            url: path,
            data: data,
            headers: {
                "Content-Type": "application/json"
            }
        }).then(
        function(response) { cb(null, response); },
        function(response) { cb("error", response); });
    }
    
    function postData(path, data, cb) {
        return bodyData("POST", path, data, cb);
    }
    
    function putData(path, data, cb) {
        return bodyData("PUT", path, data, cb);
    }
    
    function deleteData(path, data, cb) {
        return bodyData("DELETE", path, data, cb);
    }
    
    function bodyData(method, path, data, cb)
    {
        return $http({
            method: method,
            url: path,
            data: data,
            headers: {
                "Content-Type": "application/json"
            }
        }).then(
        function(response) { cb(null, response); },
        function(response) { cb("error", response); });
    }
    
    function getData(path, params, cb)
    {
        return $http({
            method: "GET",
            url: path,
            params: params
        }).then(
        function(response) { cb(null, response); },
        function(response) { cb("error", response); });
    }
    
    // public:
    
    // params = { id }
    this.getCategories = function(params, cb) {
        return getData("/category", params, cb);
    };
    
    // params = { name, description }
    this.addCategory = function(params, cb) {
        return postData("/category", params, cb);
    };
    
    // params = { id, name, description }
    this.updateCategory = function(params, cb) {
        return putData("/category", params, cb);
    };
    
    // params = { id }
    this.deleteCategory = function(params, cb) {
        return deleteData("/category", params, cb);
    };
    
    // params = { id, offset, limit, category_id, title }
    this.getNotes = function(params, cb) {
        return getData("/note", params, cb);
    };
    
    // params = { title, content, category_id }
    this.addNote = function(params, cb) {
        return postData("/note", params, cb);
    };
    
    // params = { id, title, content, category_id }
    this.updateNote = function(params, cb) {
        return putData("/note", params, cb);
    };
    
    // params = { id }
    this.deleteNote = function(params, cb) {
        return deleteData("/note", params, cb);
    };
    
}]);