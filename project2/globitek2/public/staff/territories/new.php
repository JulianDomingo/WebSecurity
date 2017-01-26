<?php
require_once('../../../private/initialize.php');

$errors = array();

if(!isset($_GET['state_id']) or !is_numeric($_GET['state_id'])) {
	// Redirect user to home page.
	redirect_to('index.php');
}

$errors = array();
$territory = array(
	'name' => '',
	'position' => ''
);

// // Need to fetch the STATE ID, not the regular ID.
// // $territory_result = find_territory_by_id($_GET['state_id']);
// $territory_result = find_territory_by_state_id($_GET['state_id']);
// // No loop, only one result
// $territory = db_fetch_assoc($territory_result);	

if (is_post_request()) {
	if(isset($_POST['name'])) { $territory['name'] = h($_POST['name']); }
	if(isset($_POST['position'])) { $territory['position'] = h($_POST['position']); }

	$result = insert_territory($territory, $_GET['state_id']);
	if ($result === True) {
		redirect_to('show.php?id=' . u(db_insert_id($db)));
	} else {
		$errors = $result;
	}
}

?>

<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
	<a href="../states/index.php">Back to State Details</a><br />

	<?php echo display_errors($errors); ?>

	<h1>New Territory</h1>

	<form action="new.php?state_id=<?php echo h($_GET['state_id']); ?>" method="post">
		Name:<br />
		<input type="text" name="name" value="<?php echo h($territory['name']); ?>" /><br />
		Position:<br />
		<input type="text" name="position" value="<?php echo h($territory['position']); ?>" /><br /><br />	
		<input type="submit" name="submit" value="Create" />	
	</form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
