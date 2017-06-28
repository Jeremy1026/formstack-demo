var foo = "bar";

$(document).ready(function() {
	console.log("Ready");
});

function deleteUser(id) {
	console.log("Deleting user: "+id);
	var request = $.ajax({
	    url: '/api/deleteUser',
	    type: 'DELETE',
	    data: { id: id }
	});
	request.success(function(result) {
	        // Do something with the result
	        console.log(result);
	    });
	request.done(function(result) {
	    	console.log(result);
	    });
}