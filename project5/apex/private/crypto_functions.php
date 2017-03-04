<?php

const DEFAULT_CIPHER_METHOD = "AES-256-CBC";

const PUBLIC_KEY_CONFIG = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Symmetric Encryption
function key_encrypt($string, $key, $cipher_method) {
  $key = pad_key_depending_on($key, $cipher_method);
  $iv = create_AES_initialization_vector($cipher_method);
  $encrypted = openssl_encrypt($string, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
  $message = $iv . $encrypted;
  return base64_encode($message);
}

function key_decrypt($string, $key, $cipher_method) {
  $key = pad_key_depending_on($key, $cipher_method);
  $iv_with_ciphertext = base64_decode($string);

  $iv_length = openssl_cipher_iv_length($cipher_method);
  $iv = substr($iv_with_ciphertext, 0, $iv_length);
  $ciphertext = substr($iv_with_ciphertext, $iv_length);

  $decrypted = openssl_decrypt($ciphertext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
  return $decrypted;
}

function create_AES_initialization_vector($cipher_method) {
  $iv_length = openssl_cipher_iv_length($cipher_method);
  $iv = openssl_random_pseudo_bytes($iv_length);
  return $iv;
}

function pad_key_depending_on($key, $cipher_method) {
  switch($cipher_method) {
    case "AES-192-CBC":
      $key = str_pad($key, 24, '*');
      break;
    case "AES-128-CBC":
      $key = str_pad($key, 16, '*');
      break;
    case "DES-EDE3":
      $key = str_pad($key, 24, '*');
      break;
    case "BF-CBC":
      $key = pad_to_blowfish_requirements($key);
      break;
    default:
      $key = str_pad($key, 32, '*');
      break;
  }
  return $key;
}

function pad_to_blowfish_requirements($key) {
  if ($key < 4) {
    return str_pad($key, 4, '*');
  }
  if ($key > 56) {
    return substr($key, strlen($key) - (strlen($key) - 56));
  }
  return $key;
}


// Asymmetric Encryption / Public-Key Cryptography
function generate_keys($config=PUBLIC_KEY_CONFIG) {
  $keys = array('private' => "",
		'public' => "");
  $resource = openssl_pkey_new($config);
  openssl_pkey_export($resource, $private_key);
  
  $key_details = openssl_pkey_get_details($resource);
  $public_key = $key_details['key'];

  $keys['private'] = $private_key;
  $keys['public'] = $public_key;

  return $keys;
}

function pkey_encrypt($string, $public_key) {
  openssl_public_encrypt($string, $encrypted_message, $public_key);
  return base64_encode($encrypted_message); 
}

function pkey_decrypt($string, $private_key) {
  openssl_private_decrypt(base64_decode($string), $decrypted_message, $private_key);
  return $decrypted_message; 
}

// Digital Signatures
function create_signature($string, $private_key) {
  openssl_sign($string, $raw_signature, $private_key);
  return base64_encode($raw_signature);
}

function verify_signature($string, $signature, $public_key) {
  $raw_signature = base64_decode($signature);
  $result = openssl_verify($string, $raw_signature, $public_key);
  return $result;
}  
  
