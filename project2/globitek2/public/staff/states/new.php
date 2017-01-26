<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['country_id']) or !is_numeric($_GET['country_id'])) {
	redirect_to('../index.php');
}

$errors = array();
$state = array(
	'name' => '',
	'code' => ''
);

if (is_post_request()) {
	if(isset($_POST['name'])) { $state['name'] = h($_POST['name']); }
	if(isset($_POST['code'])) { $state['code'] = h($_POST['code']); }	

	$result = insert_state($state, $_GET['country_id']);
	if ($result === True) {
		$new_id = u(db_insert_id($db));
		redirect_to('show.php?id=' . $new_id);
	} else {
		$errors = $result;
	}
}
?>

<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../countries/show.php?id=<?php echo u($_GET['country_id']); ?>">Back to States List</a><br />

  <h1>New State</h1>

  <?php echo display_errors($errors); ?>  

  <form action="new.php?country_id=<?php echo $_GET['country_id']; ?>" method="post">
	  Name:<br />
	  <input type="text" name="name" value="<?php echo h($state['name']); ?>"/><br />
	  Code:<br />
	  <input type="text" name="code" value="<?php echo h($state['code']); ?>"/><br />
	  <input type="submit" name="submit" value="Create"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
