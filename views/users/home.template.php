<?php include('./views/elements/header.php'); ?>
<table class="main" style="width: 80%; margin: 0 auto;">
	<tr>
		<td>User ID</td>
		<td>Email</td>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Password (Hash)</td>
		<td></td>
	</tr>
<?php foreach ($users as $user): ?>
	<tr data-user-id="<?php echo $user['id']; ?>">
	<?php foreach ($user as $key => $value): ?>
		<td class="<?php echo $key; ?>"><?php echo $value;?></td>
	<?php endforeach; ?>
		<td><a href="#" class="updateUser" data-user-id="<?php echo $user['id']; ?>">Edit</a>/<a href="#" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</a></td>
	</tr>
<?php endforeach; ?>
</table>

<button class="createNewButton" onclick="createUser()">Create New!</button>
<form method="POST" action="#" id="createUpdateForm" style="display:none;">
	<label for="email">Email Address:
		<input type="text" name="email" placeholder="email"/>
	</label>
	<label for="firstName">First Name:
		<input type="text" name="firstName" placeholder="firstName"/>
	</label>
	<label for="lastName">Last Name:
		<input type="text" name="lastName" placeholder="lastName"/>
	</label>
	<label for="password">Password:
		<input type="password" name="password" placeholder="password"/>
	</label>
	<input type="hidden" name="id">
    <input type="submit" value="Create User">
</form>
<?php include('./views/elements/footer.php'); ?>