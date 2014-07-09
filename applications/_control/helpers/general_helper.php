<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('./common/helpers/general.php');

/**
 * Builds the page using all template parts
 */
if ( ! function_exists('page_builder')) {
  function page_builder(
    $title = 'no_title',
    $body = 'body',
    $body_header = 'body_header',
    $top_nav = 'top_nav',
    $body_content = 'body_content',
    $content = 'no_content',
    $body_footer = 'body_footer'
  ) {

    $CI =& get_instance();
    $CI->load->model('modules_model');

    $modules = $CI->modules_model->get_modules();

    /* ------- generate header ------- */
    $main_data['page_title'] = $title;

    /* ------- generate content ------- */
    $lang_nav = (array)$CI->lang->line('lang_nav');
    if( $top_nav != strip_tags( $top_nav ) ) {

      $data_content = array( 'TOP_NAV' => $top_nav, 'MODULES' => $modules, 'count_modules' => count($modules) );
      $body_header_parsed = $CI->parser->parse( $body_header, array_merge($data_content, $lang_nav), true );

    } else {
      $lang = (array)$CI->lang->line('top_nav');

      $top_nav_parsed = $CI->parser->parse( $top_nav, $lang, true );

      $data_content = array( 'TOP_NAV' => $top_nav_parsed, 'MODULES' => $modules, 'count_modules' => count($modules) );
      $body_header_parsed = $CI->parser->parse( $body_header, array_merge($data_content, $lang_nav), true );

    }

    $body_content_parsed = $CI->parser->parse( $body_content, array( 'CONTENT' => $content ), true );
    $body_footer_parsed = $CI->load->view( $body_footer, '', true );

    $main_data[ 'BODY' ] = $CI->parser->parse( $body, array(
      'BODY_HEADER' => $body_header_parsed,
      'BODY_CONTENT' => $body_content_parsed,
      'BODY_FOOTER' => $body_footer_parsed
    ), true );

    return $main_data;
  }
}

/**
 * Verifies if user is logged
 */
if ( ! function_exists('session_verif')) {

  function session_verif () {

    $CI =& get_instance();

    if ( $CI->session->userdata( 'inside' ) == true ) {

      return true; dumb('dsfsdf');

    } else {

      return false;

    }

  }

}

/**
 * Gets logged user by id
 */
if ( ! function_exists('get_logged_user_by_id')) {

  function get_logged_user_by_id( $id_user ) {

    $CI =& get_instance();

    $CI->load->model('general_admin_model');

    return $CI->general_admin_model->logged_user( $id_user );

  }

}

/**
 * Gets all users
 */
if ( ! function_exists('get_all_users')) {

  function get_all_users() {

    $CI =& get_instance();

    $CI->load->model('users_model');

    return $CI->users_model->get_users();

  }

}
/* End of file general_helper.php */
/* Location: ./applications/_control/helpers/general_helper.php */