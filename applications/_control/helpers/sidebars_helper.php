<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Gets pages module filenames
 */
if ( ! function_exists('get_filenames')) {

  function get_filenames( $folder_name, $suffix ) {

    //no-content filename
    $filename[ 'no-content' ] = $folder_name . 'no-content' . $suffix;

    //list content filename
    $filename[ 'list' ] = $folder_name . 'list' . $suffix;

    //add page filename
    $filename[ 'add_sidebar' ] = $folder_name . 'add' . $suffix;

    //edit page filename
    $filename[ 'edit_sidebar' ] = $folder_name . 'edit' . $suffix;




    return $filename;

  }

}

/* End of file sidebar_helper.php */
/* Location: ./applications/_control/helpers/sidebar_helper.php */