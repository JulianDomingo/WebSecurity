<?php	
	const CIPHER_METHOD = 'AES-256-CBC';
	
	$key_plaintext = 'scrt';
	$value_plaintext = 'I have a secret to tell.';

	$key_for_key = 'aa23rbf59';
	$key_for_value = '2alkjf9f';

	$key_for_key = str_pad($key_for_key, 32, '*');
	$key_for_value = str_pad($key_for_key, 32, '*');

	$key_init_vector_length = openssl_cipher_iv_length(CIPHER_METHOD);
	$value_init_vector_length = openssl_cipher_iv_length(CIPHER_METHOD);

	$key_init_vector = openssl_random_pseudo_bytes($key_init_vector_length);
	$value_init_vector = openssl_random_pseudo_bytes($value_init_vector_length);
	
	$key_encrypted = openssl_encrypt($key_plaintext, CIPHER_METHOD, $key_for_key, OPENSSL_RAW_DATA, $key_init_vector);
	$value_encrypted = openssl_encrypt($value_plaintext, CIPHER_METHOD, $key_for_value, OPENSSL_RAW_DATA, $value_init_vector);
	$key_message = $key_init_vector . $key_encrypted;
	$value_message = $value_init_vector . $value_encrypted;

	echo base64_encode($key_message);
	echo base64_encode($value_message);

	// signing checksum
	$random_key_string = 'aS9v8wgSlckss';
	$key_message = $key_message . '--' . hash('sha1', $key_message . $random_key_string);
	
	$random_value_string = 'qw8ghsEFoudEE8';
	$value_message = $value_message . '--' . hash('sha1', $value_message . $random_value_string);
	
	setcookie($key_message, $value_message);	
?>
