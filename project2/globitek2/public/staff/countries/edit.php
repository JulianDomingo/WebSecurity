<?php
require_once('../../../private/initialize.php');

$errors = array();

if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
	redirect_to('../index.php');
}
$countries_result = find_country_by_id($_GET['id']);
// No loop, only one result
$country = db_fetch_assoc($countries_result);

if (is_post_request()) {
	if(isset($_POST['name'])) { $country['name'] = h($_POST['name']); }
	if(isset($_POST['code'])) { $country['code'] = h($_POST['code']); }	

	$result = update_country($country);
	if ($result === True) {
		redirect_to('show.php?id=' . u($_GET['id']));
	} else {
		$errors = $result;
	}
}
?>

<?php $page_title = 'Staff: Edit State ' . h($country['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Countries List</a><br />

  <h1>Edit State: <?php echo h($country['name']); ?></h1>

  <?php echo display_errors($errors); ?>  

  <form action="edit.php?id=<?php echo u($_GET['id']); ?>" method="post">
	  Name:<br />
	  <input type="text" name="name" value="<?php echo h($country['name']); ?>"/><br />
	  Code:<br />
	  <input type="text" name="code" value="<?php echo h($country['code']); ?>"/><br />
	  <input type="submit" name="submit" value="Update"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
