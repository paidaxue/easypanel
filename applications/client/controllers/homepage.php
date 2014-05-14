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

		$template = template_builder( 'default', page_sidebars(), $data );
    $this->parser->parse( 'default/base', $template );
	}

  function test() {
    $this->themes->get_theme_files();
  }
}

/* End of file homepage.php */
/* Location: ./applications/client/controllers/homepage.php */