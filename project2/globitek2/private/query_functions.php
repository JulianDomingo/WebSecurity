<?php

  //
  //**************************************** COUNTRY QUERIES ****************************************//
  //

  // Find all countries, ordered by name
  function find_all_countries() {
    global $db;
    $sql = "SELECT * FROM countries ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  // Find all states, ordered by name
  function find_countries_for_country_id($country_id=0) {
    global $db;
    $sql = "SELECT * FROM countries ";
    $sql .= "WHERE id='" . $country_id . "' ";
    $sql .= "ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  // Find state by ID
  function find_country_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM countries ";
    $sql .= "WHERE id='" . $id . "';";
    $country_result = db_query($db, $sql);
    return $country_result;
  }

  function validate_country(&$country, $errors=array()) {
    global $db;

    $country['name'] = mysqli_real_escape_string($db, $country['name']);
    $country['code'] = mysqli_real_escape_string($db, $country['code']);

    if (is_blank($country['name'])) {
      $errors[] = "County name cannot be blank.";
    } elseif (!has_length($country['name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Country name cannot exceed 255 characters.";
    } elseif (preg_match('/\A[A-Za-z\s]+\Z/', $country['name']) == 0) {
      $errors[] = "Country can only contain alphabetic letters.";
    }
    $country['name'] = strip_tags($country['name']);

    if (is_blank($country['code'])) {
      $errors[] = "Country code cannot be blank.";
    } elseif (!has_length($country['code'], array('min' => 2, 'max' => 2))) {
      $errors[] = "Country code must be 2 letters.";
    } elseif (preg_match('/\A[A-Za-z]+\Z/', $country['code']) == 0) {
      $errors[] = "Country code can only contain alphabetic letters.";
    }
    $country['code'] = strip_tags($country['code']);

    return $errors;
  }

  // Add a new country to the table
  // Either returns true or an array of errors
  function insert_country($country) { 
    global $db;

    $errors = validate_country($country);
    if (!empty($errors)) {
      return $errors;
    }
    elseif (!is_unique_country($country, $db)) {
      $errors[] = "Country already exists.";
      return $errors;
    }

    // Use prepared statements to prevent form SQL Injection.
    if ($stmt = mysqli_prepare($db, "INSERT INTO countries (name, code) VALUES(?, ?)")) {
      // "s" represents a string parameter and "i" represents an int parameter.
      $stmt->bind_param("ss", $country['name'], $country['code']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a country record
  // Either returns true or an array of errors
  function update_country($country) {
    global $db;

    $errors = validate_country($country);
    if (!empty($errors)) {
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "UPDATE countries SET name=?, code=? WHERE id=? LIMIT 1")) {
      $stmt->bind_param("ssi", $country['name'], $country['code'], $country['id']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  //**************************************** STATE QUERIES ****************************************//
  //

  // Find all states, ordered by name
  function find_all_states() {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all states, ordered by name
  function find_states_for_country_id($country_id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE country_id='" . $country_id . "' ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find state by ID
  function find_state_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE id='" . $id . "';";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  function validate_state(&$state, $errors=array()) {
    global $db;

    $state['name'] = mysqli_real_escape_string($db, $state['name']);
    $state['code'] = mysqli_real_escape_string($db, $state['code']);

    if (is_blank($state['name'])) {
      $errors[] = "State name cannot be blank.";
    } elseif (!has_length($state['name'], array('min' => 4, 'max' => 255))) {
      $errors[] = "State name cannot exceed 255 characters.";
    } elseif (preg_match('/\A[A-Za-z\s]+\Z/', $state['name']) == 0) {
      $errors[] = "State can only contain alphabetic letters.";
    }
    $state['name'] = strip_tags($state['name']);

    if (is_blank($state['code'])) {
      $errors[] = "State code cannot be blank.";
    } elseif (!has_length($state['code'], array('min' => 2, 'max' => 2))) {
      $errors[] = "State code must be 2 letters.";
    } elseif (preg_match('/\A[A-Za-z]+\Z/', $state['code']) == 0) {
      $errors[] = "State code can only contain alphabetic letters.";
    }
    $state['code'] = strip_tags($state['code']);

    return $errors;
  }

  // Add a new state to the table
  // Either returns true or an array of errors
  function insert_state($state, $country_id) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }
    elseif (!is_unique_state($state, $db)) {
      $errors[] = "State already exists.";
      return $errors;
    }

    // Use prepared statements to prevent form SQL Injection.
    if ($stmt = mysqli_prepare($db, "INSERT INTO states (name, code, country_id) VALUES(?, ?, ?)")) {
      // "s" represents a string parameter and "i" represents an int parameter.
      $stmt->bind_param("ssi", $state['name'], $state['code'], $country_id);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a state record
  // Either returns true or an array of errors
  function update_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "UPDATE states SET name=?, code=? WHERE id=? LIMIT 1")) {
      $stmt->bind_param("ssi", $state['name'], $state['code'], $state['id']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // TERRITORY QUERIES
  //

  // Find all territories, ordered by state_id
  function find_all_territories() {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "ORDER BY state_id ASC, position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all territories whose state_id (foreign key) matches this id
  function find_territories_for_state_id($state_id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE state_id='" . $state_id . "' ";
    $sql .= "ORDER BY position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

    // Find territory by State_ID
  function find_territory_by_state_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE state_id='" . $id . "';";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }


  // Find territory by ID
  function find_territory_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE id='" . $id . "';";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  function validate_territory(&$territory, $errors=array()) {
    global $db;
 
    $territory['name'] = mysqli_real_escape_string($db, $territory['name']);
    $territory['position'] = mysqli_real_escape_string($db, $territory['position']);

    if (is_blank($territory['name'])) {
      $errors[] = "Territory name cannot be blank.";
    } elseif (!has_length($territory['name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Territory must be between 2 and 255 characters.";
    } elseif (preg_match('/\A[A-Za-z\s]+\Z/', $territory['name']) == 0) {
      $errors[] = "Territory can only contain alphabetic letters.";
    } 
    $territory['name'] = strip_tags($territory['name']);

    if (is_blank($territory['position'])) {
      $errors[] = "Position cannot be blank.";
    } elseif (!has_length($territory['position'], array('min' => 1, 'max' => 255))) {
      $errors[] = "Territory position must be between 1 and 255 characters.";
    } elseif (preg_match('/\A[0-9]+\Z/', $territory['position']) == 0) {
      $errors[] = "Territory position must only contain numbers.";
    }
    $territory['position'] = strip_tags($territory['position']);

    return $errors;
  }

  // Add a new territory to the table
  // Either returns true or an array of errors
  function insert_territory($territory, $state_id) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    } elseif (!is_unique_territory($territory, $db)) {
      $errors[] = "Territory already exists.";
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "INSERT INTO territories (name, position, state_id) VALUES (?, ?, ?)")) {
      // "i" represents an integer value.
      $stmt->bind_param("sii", $territory['name'], $territory['position'], $state_id);
      $stmt->execute();
      return true;
    } 
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a territory record
  // Either returns true or an array of errors
  function update_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "UPDATE territories SET name=?, position=? WHERE id=? LIMIT 1")) {
      $stmt->bind_param("sii", $territory['name'], $territory['position'], $territory['id']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // SALESPERSON QUERIES
  //

  // Find all salespeople, ordered last_name, first_name
  function find_all_salespeople() {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find salespeople, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same territory ID.
  function find_salespeople_for_territory_id($territory_id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (salespeople_territories.salesperson_id = salespeople.id) ";
    $sql .= "WHERE salespeople_territories.territory_id='" . $territory_id . "' ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // Find salesperson using id
  function find_salesperson_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "WHERE id='" . $id . "';";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  function validate_salesperson($salesperson, $errors=array()) {
    global $db;

    $salesperson['first_name'] = mysqli_real_escape_string($db, $salesperson['first_name']);
    $salesperson['last_name'] = mysqli_real_escape_string($db, $salesperson['first_name']);
    $salesperson['email'] = mysqli_real_escape_string($db, $salesperson['email']);
    $salesperson['phone'] = mysqli_real_escape_string($db, $salesperson['phone']);

    if (is_blank($salesperson['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($salesperson['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }
    // My custom validation
    elseif (preg_match('/\A[A-Za-z\'\.\s]+\Z/', $salesperson['first_name']) == 0) {
      $errors[] = "First name should not contain non-alphabetical characters.";
    }

    if (is_blank($salesperson['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($salesperson['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }
    // My custom validation
    elseif (preg_match('/\A[A-Za-z\'\.\s]+\Z/', $salesperson['last_name']) == 0) {
      $errors[] = "Last name should not contain non-alphabetical characters.";
    }
    $salesperson['last_name'] = strip_tags($salesperson['last_name']);

    if (is_blank($salesperson['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($salesperson['email'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Email cannot exceed 255 characters.";
    } elseif (!has_valid_email_format($salesperson['email'])) {
      $errors[] = "Email must be a valid format.";
    }
    // My custom validation
    elseif (strpos($salesperson['email'], ".") === False) {
      $errors[] = "Email should contain a period.";
    }
    $salesperson['email'] = strip_tags($salesperson['email']);

    if (is_blank($salesperson['phone'])) {
      $errors[] = "Phone cannot be blank.";
    } elseif (!has_length($salesperson['phone'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Phone cannot exceed 255 characters.";
    } elseif (preg_match('/\d[0-9\s()-]+\Z/', $salesperson['phone']) == 0) {
      $errors[] = "Phone must be a valid format.";
    }
    $salesperson['phone'] = strip_tags($salesperson['phone']);

    return $errors;
  }

  // Add a new salesperson to the table
  // Either returns true or an array of errors
  function insert_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {  
      return $errors;
    }
    elseif (!is_unique_salesperson($salesperson, $db)) {
      $errors[] = "Salesperson already exists.";
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "INSERT INTO salespeople (first_name, last_name, phone, email) VALUES (?, ?, ?, ?)")) {
      // "s" represents a string parameter.
      $stmt->bind_param("ssss", $salesperson['first_name'], $salesperson['last_name'], $salesperson['phone'], $salesperson['email']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a salesperson record
  // Either returns true or an array of errors
  function update_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "UPDATE salespeople SET first_name=?, last_name=?, phone=?, email=? WHERE id=? LIMIT 1")) {
      $stmt->bind_param("ssssi", $salesperson['first_name'], $salesperson['last_name'], $salesperson['phone'], $salesperson['email'], $salesperson['id']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // To find territories, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same salesperson ID.
  function find_territories_by_salesperson_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (territories.id = salespeople_territories.territory_id) ";
    $sql .= "WHERE salespeople_territories.salesperson_id='" . $id . "' ";
    $sql .= "ORDER BY territories.name ASC;";
    $territories_result = db_query($db, $sql);
    return $territories_result;
  }

  //
  // USER QUERIES
  //

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  // Find user using id
  function find_user_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM users WHERE id='" . $id . "' LIMIT 1;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  function validate_user(&$user, $errors=array()) {
    global $db;

    $user['first_name'] = mysqli_real_escape_string($db, $user['first_name']);
    $user['last_name'] = mysqli_real_escape_string($db, $user['last_name']);
    $user['email'] = mysqli_real_escape_string($db, $user['email']);
    $user['username'] = mysqli_real_escape_string($db, $user['username']);

    if (is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }
    $user['first_name'] = strip_tags($user['first_name']);

    if (is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }
    $user['last_name'] = strip_tags($user['last_name']);

    if (!is_unique_user($user, $db)) {
      $errors[] = "User already exists.";
    }

    if (is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }
    $user['email'] = strip_tags($user['email']);

    if (is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('max' => 255))) {
      $errors[] = "Username must be less than 255 characters.";
    } elseif (!is_unique_username($user, $db)) {
      $errors[] = "Username already exists.";
    }
    $user['username'] = strip_tags($user['username']);

    return $errors;
  }

  // Add a new user to the table
  // Either returns true or an array of errors
  function insert_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    if ($stmt = mysqli_prepare($db, "INSERT INTO users (first_name, last_name, email, username, created_at) VALUES (?, ?, ?, ?, ?)")) {
      $created_at = date("Y-m-d H:i:s");
      $stmt->bind_param("sssss", $user['first_name'], $user['last_name'], $user['email'], $user['username'], $created_at);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a user record
  // Either returns true or an array of errors
  function update_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {

      return $errors;
    }
    // The updated username is unique to the users table. The user can successfully change his username to the value specified.
    if ($stmt = mysqli_prepare($db, "UPDATE users SET first_name=?, last_name=?, email=?, username=? WHERE id=? LIMIT 1")) {
      $stmt->bind_param("ssssi", $users['first_name'], $users['last_name'], $users['email'], $users['username'], $users['id']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  function delete_user($user) {
    global $db;

    if ($stmt = mysqli_prepare($db, "DELETE from users WHERE username=?")) {
      $stmt->bind_param("s", $user['username']);
      $stmt->execute();
      return true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Pass errors list by reference to retain error statement.
  function is_unique_salesperson($salesperson, $db) {
    $sql = "SELECT * FROM salespeople WHERE ";
    $sql .= "(first_name='" . $salesperson['first_name'] . "' AND ";
    $sql .= "last_name='" . $salesperson['last_name'] . "')";

    $query = db_query($db, $sql);
    if (db_num_rows($query) > 0) {
        return False;
    }
    return True;
  }

  function is_unique_username($user, $db) {
    if ($stmt = mysqli_prepare($db, "SELECT * FROM users WHERE username=?")) {
      $stmt->bind_param("s", $user['username']);
      $stmt->execute();
      $stmt->store_result();
      return ($stmt->num_rows > 0) ? False : True;
      // echo "<h2>" . $stmt->num_rows . "</h2>";
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Pass errors list by reference to retain error statement.
  function is_unique_user($user, $db) {
    if ($stmt = mysqli_prepare($db, "SELECT * FROM users WHERE first_name=? && last_name=? AND id != ?")) {
      $stmt->bind_param("ssi", $user['first_name'], $user['last_name'], $user['id']);
      $stmt->execute();
      $stmt->store_result();
      return ($stmt->num_rows > 0) ? false : true;
    }
    else {
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Pass errors list by reference to retain error statement.
  function is_unique_state($state, $db) {
    $sql = "SELECT * FROM states WHERE (name='" . $state['name'] . "');";
    $query = db_query($db, $sql);
    if (db_num_rows($query) > 0) {
        return False;
    }
    return True;
  }

  // Pass errors list by reference to retain error statement.
  function is_unique_territory($territory, $db) {
    $sql = "SELECT * FROM territories WHERE (name='" . $territory['name'] . "');";
    $query = db_query($db, $sql);
    if (db_num_rows($query) > 0) {
        return False;
    }
    return True;
  }

  // Pass errors list by reference to retain error statement.
  function is_unique_country($country, $db) {
    $sql = "SELECT * FROM countries WHERE (name='" . $country['name'] . "');";
    $query = db_query($db, $sql);
    if (db_num_rows($query) > 0) {
        return False;
    }
    return True;
  }
?>
