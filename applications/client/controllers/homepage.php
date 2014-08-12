<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends MY_Controller {

  function __construct() {
    parent::__construct();

    $this->load->model('main_model');
  }

	/**
		* Homepage
		*/
	function index () {
		$page_info = $this->main_model->get_homepage();
    $sidebars = $this->main_model->set_sidebars($page_info);

    $data = array(
      'page_title'    => $page_info->title,
      'page_content'  => $page_info->content,
      'homepage'      => true
    );

		$template = $this->themes->build_template($data, $sidebars, true);
    $base = $this->themes->get_base();
    $this->parser->parse($base, $template);
	}
}