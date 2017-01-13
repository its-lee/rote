angular.module('rote').controller("note", function($scope, $http) {
	
	var rote = new RoteClient($http);
	
	$scope.getNotes = function()
	{
		rote.getNotes({}, function(err, response) {
			$scope.notes = err ? [] : response.data;
		});
	}
	
	$scope.deleteNote = function(note) {
		rote.deleteNote({ id: note.id }, function(err, response) {
			if (!err)
				$scope.notes = _.reject($scope.notes, function(n) { return n.id === note.id; });
		});
	}
	
	$scope.notes = [];
	$scope.getNotes();
});