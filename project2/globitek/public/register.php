<?php
  require_once('../private/initialize.php');
  $has_errors = False;
  $inputs = array("First name"=>"", "Last name"=>"", "Email"=>"", "Username"=>"");
  $errors = array("First name"=>"", "Last name"=>"", "Email"=>"", "Username"=>"");
?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
    if (is_post_request()) {
        // Begin reading the text inputs.
        $inputs['First name'] = isset($_POST['first_name']) ? $_POST['first_name'] : "";
        $inputs['Last name'] = isset($_POST['last_name']) ? $_POST['last_name'] : "";
        $inputs['Email'] = isset($_POST['email']) ? $_POST['email'] : "";
        $inputs['Username'] = isset($_POST['username']) ? $_POST['username'] : "";

        $errors = validate("First name", $inputs['First name'], $errors);
        $errors = validate("Last name", $inputs['Last name'], $errors);
        $errors = validate("Email", $inputs['Email'], $errors);
        $errors = validate("Username", $inputs['Username'], $errors);

        $inputs['Email'] = filter_var($inputs['Email'], FILTER_SANITIZE_EMAIL);

        $errors = check_unique_username($inputs['Username'], $errors, $db);

        if (has_no_errors($errors)) {
            $inputs["First name"] = mysqli_real_escape_string($db, $inputs["First name"]);
            $inputs["Last name"] = mysqli_real_escape_string($db, $inputs["Last name"]);
            $inputs["Email"] = mysqli_real_escape_string($db, $inputs["Email"]);
            $inputs["Username"] = mysqli_real_escape_string($db, $inputs["Username"]);

            // Ready the SQL statement.
            date_default_timezone_set('America/Chicago');
            // $sql = "INSERT INTO users (first_name, last_name, email, username) VALUES ('$first_name','$last_name','$email','$username')";
            $sql = "INSERT INTO users (first_name, last_name, email, username) VALUES ('".$inputs['First name']."','".$inputs['Last name']."','".$inputs['Email']."','".$inputs['Username']."')";
            $query = db_query($db, $sql);

            // Validate query was successful.
            if ($query) {
                db_close($db);
                redirect_to("./registration_success.php");
            }
            else {
                // The SQL INSERT statement failed.
                echo db_error($db);
                db_close($db);
                exit;
            }
        }
    }
?>

<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/css/bootstrap-flex.css"></link>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="../css/register.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div id="main-content" class="jumbotron container">
            <div class="intro">
                <h1>Register</h1>
                <p>Register to become a Globitek Partner.</p>
            </div>
            <form action="./register.php" method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo $inputs['First name']; ?>">
                    <?php if (strcmp($errors["First name"], "") != 0) { ?>
                            <div id="first_name_error" class="alert alert-danger">
                                <a href="#" class="close" id="first_name_error_exit" date-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?php echo $errors["First name"];?></strong>
                            </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo $inputs['Last name']; ?>">
                    <?php if (strcmp($errors["Last name"], "") != 0) { ?>
                            <div id="last_name_error" class="alert alert-danger">
                                <a href="#" class="close" id="last_name_error_exit" date-dismiss="alert" aria-label="close">&times;</a>                            
                                <strong><?php echo $errors["Last name"];?></strong>
                            </div>
                    <?php } ?>                    
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $inputs['Email']; ?>">
                    <?php if (strcmp($errors["Email"], "") != 0) { ?>
                            <div id="email_error" class="alert alert-danger">
                                <a href="#" class="close" id="email_error_exit" date-dismiss="alert" aria-label="close">&times;</a>                            
                                <strong><?php echo $errors["Email"];?></strong>
                            </div>
                    <?php } ?>                    
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $inputs['Username']; ?>">
                    <?php if (strcmp($errors["Username"], "") != 0) { ?>
                            <div id="username_error" class="alert alert-danger">
                                <a href="#" class="close" id="username_error_exit" date-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?php echo $errors["Username"];?></strong>
                            </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </body>
</html>

<?php include(SHARED_PATH . '/footer.php'); ?>

<!-- Javascript function to close alert boxes. -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#first_name_error_exit').click(function () {
            $('#first_name_error').hide('fade');
        });
        $('#last_name_error_exit').click(function () {
            $('#last_name_error').hide('fade');
        });
        $('#username_error_exit').click(function () {
            $('#username_error').hide('fade');
        });
        $('#email_error_exit').click(function () {
            $('#email_error').hide('fade');
        });
    });
</script>

