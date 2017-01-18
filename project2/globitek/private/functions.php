<?php

  function h($string="") {
    return htmlspecialchars($string);
  }

  function u($string="") {
    return urlencode($string);
  }

  function raw_u($string="") {
    return rawurlencode($string);
  }

  function redirect_to($location) {
    header("Location: " . $location);
    exit;
  }

  function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
  }

  function display_errors($errors) {
    $output = '';
    $has_errors = False;
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:"."<br />";
    $output .= "<ul>";
    foreach ($errors as $key => $value) {
      if (strcmp($value, "") != 0) {
        $output .= "<li>{$value}</li>";
        $has_errors = True;
      }
    }
    $output .= "</ul>";
    $output .= "</div>";

    return ($has_errors) ? $output : "";
  }

  function validate($key, $value, $errors) {
      if (strcmp($value, "") == 0) {
        $errors[$key] = "{$key} cannot be blank.";
      } 
      else if (strcmp($key, "First name") == 0 or strcmp($key, "Last name") == 0) {
        if (!has_length($value, ['min' => 2, 'max' => 255])) {
          $errors[$key] = "{$key} must be between 2 and 255 characters.";
        } else if (preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $value) == 0) {
          $errors[$key] = "{$key} must be a valid format.";
        }
      }
      else {
        if (!has_length($value, ['min' => 8, 'max' => 255])) {
          $errors[$key] = "{$key} must be between 8 and 255 characters.";
        } 
        if (strcmp($key, "Email") == 0) {
          if (!has_valid_email_format($value)) {
            $errors[$key] = "Email must be a valid format.";
          }
        }
        if (strcmp($key, "Username") == 0) {
          if (preg_match('/\A[0-9A-Za-z\s_]+\Z/', $value) == 0) {
            $errors[$key] = "Username must be a valid format.";
          }
        }
      }
      return $errors;
  }

  function check_unique_username($username, $errors, $db) {
    $sql ="SELECT username FROM users WHERE username = '$username'";
    $query = db_query($db, $sql);
    if (db_num_rows($query) > 0) {
        // Username already exists in database. Do not add it.
        $errors['Username'] = "Username already exists.";
    }
    return $errors;
  }

  function has_no_errors($errors) {
    foreach ($errors as $key => $value) {
      if (strcmp($value, "") != 0) {
        return False;
      }
    }
    return True;
  }
?>
