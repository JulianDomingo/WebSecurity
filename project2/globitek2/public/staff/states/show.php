<?php require_once('../../../private/initialize.php'); ?>

<?php
if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
  redirect_to('../index.php');
}

$state_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($state_result);
?>

<?php $page_title = 'Staff: State of ' . h($state['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../countries/show.php?id=<?php echo $state['country_id']; ?>">Back to Country Details</a><br />

  <h1>State: <?php echo h($state['name']); ?></h1>

  <?php
    echo "<table id=\"state\">";
    echo "<tr>";
    echo "<td>Name: </td>";
    echo "<td>" . h($state['name']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Code: </td>";
    echo "<td>" . h($state['code']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Country: </td>";
    // Fetch country belonging to state.
    $country_result = find_country_by_id($state['country_id']);
    $country = db_fetch_assoc($country_result);
    echo "<td>" . h($country['name']) . "</td>";
    echo "</tr>";
    echo "</table>";
?>
    <br />
    <a href="edit.php?id=<?php echo u($state['id']); ?>">Edit</a><br />
    <hr />

    <h2>Territories</h2>
    <br />
    <a href="../territories/new.php?state_id=<?php echo u($state['id']); ?>">Add a Territory</a><br />

<?php
    $territory_result = find_territories_for_state_id($state['id']);

    echo "<ul id=\"territories\">";
    while($territory = db_fetch_assoc($territory_result)) {
      echo "<li>";
      echo "<a href=\"../territories/show.php?id=" . u($territory['id']) . "\">";
      echo h($territory['name']);
      echo "</a>";
      echo "</li>";
    } // end while $territory
    db_free_result($territory_result);
    echo "</ul>"; // #territories

    db_free_result($state_result);
  ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
