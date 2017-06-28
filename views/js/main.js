var updating = false;

$(document).ready(function()
{
    // console.log("Ready");
});

function deleteUser(id)
{
    // console.log("Deleting user: "+id);
    var request = $.ajax({
        url: '/api/deleteUser',
        type: 'POST',
        data:
        { 'id': id }
    })
    .done(function(result)
    {
        var row = $('.main').find("[data-user-id='"+id+"']");
        row.hide("fast", function()
        {
        row.remove();
        });
    });
}

function createUser()
{
    $(".createNewButton").hide("fast");
    $('#createUpdateForm').show("fast");
}

$(document).on('click', '.updateUser', function(e)
{ 
    $(".createNewButton").hide("fast");
    $('#createUpdateForm').show("fast");
    $('#createUpdateForm').find("input[type='submit']").val("Update User");
    var target = e.target;
    var row = $('.main').find("[data-user-id='"+$(target).data('user-id')+"']");

    var email = row.find('.email');
    $('#createUpdateForm').find("input[name='email']").val(email.html()).attr("placeholder", "");

    var firstName = row.find('.first_name');
    $('#createUpdateForm').find("input[name='firstName']").val(firstName.html()).attr("placeholder", "");

    var lastName = row.find('.last_name');
    $('#createUpdateForm').find("input[name='lastName']").val(lastName.html()).attr("placeholder", "");

    $('#createUpdateForm').find("input[name='password']").attr("placeholder", "password");

    var id = $(target).data('user-id');
    $('#createUpdateForm').find("input[name='id']").val(id);
    updating = true;
});

$("#createUpdateForm").submit(function(e)
{
    if (!updating)
    {
    var url = '/api/createUser';
    } else
    {
    var url = '/api/updateUser';
    }
    var request = $.ajax({
        url: url,
        type: 'POST',
        data: $("#createUpdateForm").serialize()
    })
    .done(function(result)
    {
    console.log(result);
           var parsedResult = JSON.parse(result);
           if (parsedResult['success'] == true)
           {
           updateUserList();
           $("#createUpdateForm").find("input[type=text], input[type=password]").val("");
       $('#createUpdateForm').hide("fast");
    $(".createNewButton").show("fast");
           }
    });

    e.preventDefault();
})

function updateUserList()
{
    var request = $.ajax({
        url: '/api/getUsers',
    })
    .done(function(result)
    {
        var parsedResult = JSON.parse(result);
        var list = "<tr><td>User ID</td>"+
        "<td>Email</td>"+
        "<td>First Name</td>"+
        "<td>Last Name</td>"+
        "<td>Password</td>"+
        "<td></td></tr>";
        parsedResult.forEach(function(element)
        {
           list += "<tr data-user-id='"+element['id']+"'>"+
           "<td>"+element['id']+"</td>"+
           "<td>"+element['email']+"</td>"+
           "<td>"+element['first_name']+"</td>"+
           "<td>"+element['last_name']+"</td>"+
           "<td>"+element['password']+"</td>"+
           "<td><a href='#' class='updateUser' data-user-id='"+element['id']+"'>Edit</a>/<a href='#' onclick='deleteUser("+element['id']+")''>Delete</a></td>"+
           "</tr>";
        });
    $('.main').html(list);
    });
}
