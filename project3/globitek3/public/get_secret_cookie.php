<?php
	$secret = $_COOKIE['scrt'];
	if (signed_string_is_valid($secret)) {
		// Decrypt
		const CIPHER_METHOD = 'AES-256-CBC';
	
		$key = '2alkjf9f';
		
		$key = str_pad($key, 32, '*');
	
		$init_vector_with_ciphertext = base64_decode($secret);
	
		// Separate encrypted message and init vector
		$init_vector_length = openssl_ciper_iv_length(CIPHER_METHOD);
		$init_vector = substr($init_vector_with_ciphertext, 0, $init_vector_length);
		$ciphertext = substr($iv_with_ciphertext, $init_vector_length);

		// Decrypt
		$actual_message = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $init_vector);

		echo $actual_message;
	}
	else [
		echo "Unsecure cookie. The cookie monster will dispose of it.";
	}
?>
