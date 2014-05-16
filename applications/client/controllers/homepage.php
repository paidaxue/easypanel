<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MY_Controller {

  function __construct() {
    parent::__construct();

    $this->load->model( 'main_model' );
  }

	/**
		* Homepage
		*/
	function index () {
		$page_info = $this->main_model->get_homepage();

    $data = array(
      'page_title'    => $page_info->title,
      'page_content'  => $page_info->content
    );

		$template = $this->themes->build_template(
      $data,
      $page_info->sidebar_style,
      $page_info->sidebar_right != 0 ? $page_info->sidebar_right : '0',
      $page_info->sidebar_left != 0 ? $page_info->sidebar_left : '0'
    );
    $base = $this->themes->get_base();
    $this->parser->parse($base, $template);
	}

}

/* End of file homepage.php */
/* Location: ./applications/client/controllers/homepage.php */