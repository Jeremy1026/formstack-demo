<table class="main">
	<tr>
		<td>User ID</td>
		<td>Email</td>
		<td>First Name</td>
		<td>Last Name</td>
		<td>Password (Hash)</td>
	</tr>
<?php foreach ($users as $user): ?>
	<tr>
	<?php foreach ($user as $key => $value): ?>
		<td class="<?php echo $key; ?>"><?php echo $value;?></td>
	<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>