<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

  function __construct() {

      parent::__construct();

  }

	function _remap( $page_slug ) {

		$this->index( $page_slug );

	}

	/**
		* Main function for generating pages
		*/
	function index ( $page_slug ) {

		$page_info = $this->main_model->get_page_by_page_slug($page_slug);

		$data = array(
      'page_title'    => $page_info->title,
      'page_content'  => $page_info->content
    );

		$template = template_builder( 'default', page_sidebars(), $data );
    $this->parser->parse( 'default/base', $template );

	}

}

/* End of file page.php */
/* Location: ./applications/client/controllers/page.php */