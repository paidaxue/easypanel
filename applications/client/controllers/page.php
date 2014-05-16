<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

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

/* End of file page.php */
/* Location: ./applications/client/controllers/page.php */