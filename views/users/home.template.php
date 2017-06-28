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
	<tr>
	<?php foreach ($user as $key => $value): ?>
		<td class="<?php echo $key; ?>"><?php echo $value;?></td>
	<?php endforeach; ?>
		<td><a href="./user/edit">Edit</a>/<a href="#" onclick="deleteUser(<?php echo $user['id']; ?>)">Delete</a></td>
	</tr>
<?php endforeach; ?>
</table>

<button onclick="createUser()">Create New!</button>
<?php include('./views/elements/footer.php'); ?>