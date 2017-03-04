<?php
  function signing_checksum($string) {
    return md5($string);
  }

  function sign_string($string) {
    return $string . '--' . signing_checksum($string);
  }

  function signed_string_is_valid($signed_string) {
    $array = explode('--', $signed_string);
    // if not 2 parts it is malformed or not signed
    if(count($array) != 2) { return false; }

    $new_checksum = signing_checksum($array[0]);
    return ($new_checksum === $array[1]);
  }

  function remove_checksum($signed_message) {
    $array = explode('--', $signed_message);
    return $array[0];
  }
?>

