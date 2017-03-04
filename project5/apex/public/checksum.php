<?php
  require_once('../private/checksum_functions.php');
  require_once('../private/initialize.php');

  $message = '';
  $result_text = '';

  if (is_post_request()) {
  
    if(isset($_POST['create_checksum'])) {
    
      // This is a create checksum request
      $message = isset($_POST['message']) ? $_POST['message'] : nil;
      $result_checksum = sign_string($message);
    
    } else {
      // This is a verify checksum request
      $message = isset($_POST['message']) ? $_POST['message'] : nil;
      $result_checksum = $message;
      $result = signed_string_is_valid($message); 
      $result_text = ($result == 1) ? 'Valid' : 'Not valid';
    }
  }

?>

<!doctype html>

<html lang="en">
  <head>
    <title>Asymmetric Encryption: Create/Verify Signature</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <link rel="stylesheet" media="all" href="includes/styles.css" />
  </head>
  <body>
    
    <a href="index.php">Main menu</a>
    <br/>

    <h1>Symmetric Encryption</h1>
    
    <div id="encoder">
      <h2>Create Checksum</h2>

      <form action="" method="post">
        <div>
          <label for="message">Message</label>
          <textarea name="message"><?php echo h(remove_checksum($message)); ?></textarea>
        </div>
        <div>
          <input type="submit" name="create_checksum" value="Create">
        </div>
      </form>
    
      <div class="result"><?php echo h($result_checksum); ?></div>
      <div style="clear:both;"></div>
    </div>
    
    <hr />
    
    <div id="decoder">
      <h2>Verify Checksum</h2>

      <form action="" method="post">
        <div>
          <label for="message">Message</label>
          <textarea name="message"><?php echo h($result_checksum); ?></textarea>
        </div>
        <div>
          <input type="submit" name="verify_checksum" value="Verify">
        </div>
      </form>

      <div class="result"><?php echo h($result_text); ?></div>
      <div style="clear:both;"></div>
    </div>
    
  </body>
</html>
