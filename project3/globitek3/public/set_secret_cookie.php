<?php	
	include 'checksum_functions.php';
	const CIPHER_METHOD = 'AES-256-CBC';

	$key_plaintext = 'scrt';	
	$value_plaintext = 'I have a secret to tell.';

	$key_for_value = str_pad('a1b2c3d4e5', 32, '*');

	$value_init_vector_length = openssl_cipher_iv_length(CIPHER_METHOD);
	$value_init_vector = openssl_random_pseudo_bytes($value_init_vector_length);

	$value_encrypted = openssl_encrypt($value_plaintext, CIPHER_METHOD, $key_for_value, OPENSSL_RAW_DATA, $value_init_vector);
	$value_message = $value_init_vector . $value_encrypted;

	$encrypted_message = base64_encode($value_message);
	echo "The viewable encrypted key is: " .  $encrypted_message;	
	
	$value_message = sign_string($value_message);

	setcookie($key_plaintext, $value_message);	
?>
