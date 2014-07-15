<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Gets login filenames
 */
if ( ! function_exists('get_filenames')) {
  function get_filenames( $folder_name, $suffix ) {
    $filename[ 'top_nav' ] = $folder_name . 'top_nav' . $suffix;
    $filename[ 'body_header' ] = $folder_name . 'body_header' . $suffix;
    $filename[ 'content' ] = $folder_name . 'content' . $suffix;

    return $filename;
  }
}

/**
 * Gets login module filenames
 */
if ( ! function_exists('create_session')) {
  function create_session( $user ) {
    $CI =& get_instance();

    $session_data = array(
      'id_user' => $user->id_user,
      'username' => $user->user,
      'avatar' => $user->avatar,
      'inside' => true,
    );

    $CI->session->set_userdata( $session_data );

    return true;
  }
}