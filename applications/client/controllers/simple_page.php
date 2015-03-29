<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simple_page extends MY_Controller {

	/**
	 * Main function for generating pages
	 */
	function index ( $page_slug ) {
		$page_info = $this->main_model->get_page_by_page_slug($page_slug);
    $sidebars = $this->main_model->set_sidebars($page_info);

		$data = array(
      'page_title'    => $page_info->title,
      'page_content'  => $page_info->content
    );

    $template = $this->themes->build_template($data, $sidebars);
    $base = $this->themes->get_base();
    $this->parser->parse($base, $template);
	}
}

/* End of file page.php */
/* Location: ./applications/client/controllers/page.php */