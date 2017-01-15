<?php
  require_once('../private/initialize.php');

  $first_name = '';
  $last_name = '';
  $email = '';
  $username = '';

  $error_prints = [];

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
    if (is_post_request()) {

        // Begin reading the text inputs.
        $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : "";
        $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $username = isset($_POST['username']) ? $_POST['username'] : "";

        if (is_blank($_POST['first_name'])) {
          $error_prints[] = "First name cannot be blank.";
        } elseif (!has_length($_POST['first_name'], ['min' => 2, 'max' => 255])) {
          $error_prints[] = "First name must be between 2 and 20 characters.";
        } else if (preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $first_name) == 0) {
          $error_prints[] = "First name must be a valid format.";
        }
        if (is_blank($_POST['last_name'])) {
          $error_prints[] = "Last name cannot be blank.";
        } elseif (!has_length($_POST['last_name'], ['min' => 2, 'max' => 30])) {
          $error_prints[] = "Last name must be between 2 and 30 characters.";
        } else if (preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $last_name) == 0) {
          $error_prints[] = "Last name must be a valid format.";
        }
        if (is_blank($_POST['email'])) {
          $error_prints[] = "Email cannot be blank.";
        } elseif (!has_length($_POST['email'], ['min' => 8, 'max' => 255])) {
          $error_prints[] = "Email must be between 8 and 255 characters.";
        } elseif (!has_valid_email_format($email)) {
          $error_prints[] = "Email must be a valid format.";
        }
        if (is_blank($_POST['username'])) {
          $error_prints[] = "Username cannot be blank.";
        } elseif (!has_length($_POST['username'], ['min' => 8, 'max' => 255])) {
          $error_prints[] = "Username must be between 8 and 255 characters.";
        }

        // Unique Username.
        $sql ="SELECT username FROM users WHERE username = '$username'";
        $query = db_query($db, $sql);
        if (db_num_rows($query) > 0) {
            // Username already exists in database. Do not add it.
            $error_prints[] = "Username already exists. Change it to something else.";
        }

        if (empty($error_prints)) {
            // Escape strings that will be used in a SQL statement.
            $first_name = mysqli_real_escape_string($db, $first_name);
            $last_name = mysqli_real_escape_string($db, $last_name);
            $email = mysqli_real_escape_string($db, $email);
            $username = mysqli_real_escape_string($db, $username);

            // Ready the SQL statement.
            date_default_timezone_set('America/Chicago');

            $sql = "INSERT INTO users (first_name, last_name, email, username) VALUES ('$first_name','$last_name','$email','$username')";
            $query = db_query($db, $sql);

            // Validate query was successful.
            if ($query) {
                db_close($db);
                redirect_to("./registration_success.php");
            }
            else {
                // The SQL INSERT statement failed.
                // Just show the error, not the form
                echo db_error($db);
                db_close($db);
                exit;
            }
        }
        else {
            echo "<h2>Errors found.</h2>";
            echo display_errors($error_prints);
        }
    }

?>

<html lang="en">
  <head>
  </head>
  <body>
    <div id="main-content">
      <h1>Register</h1>
      <p>Register to become a Globitek Partner.</p>
      <br />
      <form action="./register.php" method="post">
        First Name:
        <br />
        <input type="text" name="first_name" value="<?php echo $first_name; ?>">
        <br />
        Last Name:
        <br />
        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
        <br />
        Email:
        <br />
        <input type="text" name="email" value="<?php echo $email; ?>">
        <br />
        Username:
        <br />
        <input type="text" name="username" value="<?php echo $username; ?>">
        <br />
        <br />
        <input type="submit" name="submit">
      </form>
    </div>
  </body>
</html>

<?php include(SHARED_PATH . '/footer.php'); ?>
