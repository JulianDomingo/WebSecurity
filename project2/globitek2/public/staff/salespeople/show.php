<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
  redirect_to('../index.php');
}

$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);
?>

<?php $page_title = 'Staff: Salesperson ' . h($salesperson['first_name']) . " " . h($salesperson['last_name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Salesperson: <?php echo h($salesperson['first_name']) . " " . h($salesperson['last_name']); ?></h1>

  <?php
    echo "<table id=\"salesperson\">";
    echo "<tr>";
    echo "<td>Name: </td>";
    echo "<td>" . h($salesperson['first_name']) . " " . h($salesperson['last_name']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Phone: </td>";
    echo "<td>" . h($salesperson['phone']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Email: </td>";
    echo "<td>" . h($salesperson['email']) . "</td>";
    echo "</tr>";
    echo "</table>";

    db_free_result($salespeople_result);
  ?>
  <br />
  <?php echo "<a href=\"edit.php?id=" . u($salesperson['id']) . "\">Edit</a><br />"; ?>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
