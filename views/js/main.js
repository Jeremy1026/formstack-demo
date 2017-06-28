$(document).ready(function() {
	console.log("Ready");
updateUserList();
});

function deleteUser(id) {
	// console.log("Deleting user: "+id);
	var request = $.ajax({
	    url: '/api/deleteUser',
	    type: 'POST',
	    data: { 'id': id }
	})
	.done(function(result) {
	   	console.log(result);
    });
}

function createUser() {
	$('#createUserForm').show("fast");
}

$("#createUserForm").submit(function(e) {
	var request = $.ajax({
	    url: '/api/createUser',
	    type: 'POST',
	    data: $("#createUserForm").serialize()
    })
	.done(function(result) {
	   	console.log(result);
	   	var parsedResult = JSON.parse(result);
	   	if (parsedResult['success'] == true) {
	   		updateUserList();
	   		$("#createUserForm").find("input[type=text], input[type=password]").val("");
   			$('#createUserForm').hide("fast");

	   	}
    });
	e.preventDefault();
})

function updateUserList() {
	var request = $.ajax({
	    url: '/api/getUsers',
	})
	.done(function(result) {
	   	var parsedResult = JSON.parse(result);
	   	var list = "<tr><td>User ID</td>"+
	   					 "<td>Email</td>"+
	   					 "<td>First Name</td>"+
	   					 "<td>Last Name</td>"+
	   					 "<td>Password</td>"+
	   					 "<td></td></tr>";
	   	parsedResult.forEach(function(element) {
	   		console.log(element);
	   		list += "<tr>"+
	   					"<td>"+element['id']+"</td>"+
	   					"<td>"+element['first_name']+"</td>"+
	   					"<td>"+element['last_name']+"</td>"+
	   					"<td>"+element['password']+"</td>"+
	   					"<td><a href='./user/edit'>Edit</a>/<a href='#' onclick='deleteUser("+element['id']+")''>Delete</a></td>"+
	   				"</tr>";
	   	});
	   	$('.main').html(list);
    });
}
