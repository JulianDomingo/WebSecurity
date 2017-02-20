<?php
	include 'checksum_functions.php';

	const CIPHER_METHOD = 'AES-256-CBC';

        $secret = $_COOKIE['scrt'];
	//if (signed_string_is_valid($secret)) {		
                $key = '2alkjf9f';

                $key = str_pad($key, 32, '*');

		//$secret = get_encrypted_message($secret);
		$unencrypted_key = base64_encode($secret);	
		echo "The unencrypted key is: " . $unencrypted_key;
		$init_vector_with_ciphertext = base64_decode($unencrypted_key);
                // Separate encrypted message and init vector
                $init_vector_length = openssl_cipher_iv_length(CIPHER_METHOD);
                $init_vector = substr($init_vector_with_ciphertext, 0, $init_vector_length);
                $ciphertext = substr($iv_with_ciphertext, $init_vector_length);
		echo "<br/>";
                // Decrypt
                $actual_message = openssl_decrypt($ciphertext, CIPHER_METHOD, $key, OPENSSL_RAW_DATA, $init_vector);
                echo "The secret message is: " . $actual_message;
        //}
        //else {
        //        echo "Unsecure cookie. The cookie monster will dispose of it.";
        //}
?>
