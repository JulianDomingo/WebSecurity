<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
  redirect_to('../index.php');
}
$users_result = find_user_by_id($_GET['id']);
// No loop, only one result
$user = db_fetch_assoc($users_result);

if (is_post_request()) {
	// Delete the user.
	$result = delete_user($user);
	if($result === true) {
		redirect_to('index.php');
	} else {
		echo "Result failed.";
		$errors = $result;
	}
}
?>

<h2>Are you sure you want to permanently delete this user?</h2>
<form action="delete.php?id=<?php echo $user['id']; ?>" method="post">
	<input type="submit" name="Yes" value="Yes">
</form>

<form action="index.php" method="post">
	<input type="submit" name="No" value="No">
</form>