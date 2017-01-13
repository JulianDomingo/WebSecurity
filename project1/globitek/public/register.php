<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.
  // with text inputs: first_name, last_name, email, username


  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<html lang="en">
  <head>
    <title>Registration Form</title>
  </head>
  <body>
    <div id="main-content">
      <h1>Register</h1>
      <p>Register to become a Globitek Partner.</p>
      <br>
      <form action="public/register.php">
        First Name:
        <input type="text" value="first_name">
        <br>
        Last Name:
        <input type="text" value="last_name">
        <br>
        Email:
        <input type="text" value="email">
        <br>
        Username:
        <input type="text" value="username">
        <br>
        <input type="submit" value="Submit">
      </form>
      <?php
        // TODO: display any form errors here
        // Hint: private/functions.php can help
      ?>

      <!-- TODO: HTML form goes here -->

    </div>
  </body>
</html>

<?php include(SHARED_PATH . '/footer.php'); ?>
