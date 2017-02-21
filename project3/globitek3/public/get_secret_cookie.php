<?php
	include 'checksum_functions.php';
	const CIPHER_METHOD = 'AES-256-CBC';

        $secret = $_COOKIE['scrt'];
	if (signed_string_is_valid($secret)) {		
                $key = 'a1b2c3d4e5'; 

                $key = str_pad($key, 32, '*');

		$secret = remove_checksum($secret);
		$viewable_encrypted_key = base64_encode($secret);	
		$init_vector_with_ciphertext = base64_decode($viewable_encrypted_key);

                $init_vector_length = openssl_cipher_iv_length(CIPHER_METHOD);
                $init_vector = substr($init_vector_with_ciphertext, 0, $init_vector_length);
                $ciphertext = substr($init_vector_with_ciphertext, $init_vector_length);
                
                $actual_message = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $init_vector);
                echo "The secret message is: " . $actual_message;
        }
        else {
                echo "Unsecure cookie. The cookie monster will dispose of it.";
        }
?>
