<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	function __construct() {
    parent::__construct();

		/* Load models */
		$this->load->model('dashboard_admin_model');
  }

	/**
	 * Dashboard main page
	 * @return void
	 */
	function index() {
		$page_records = $this->dashboard_admin_model->get_page_records();
		$page_records_no = count( $page_records );

		$modules = $this->dashboard_admin_model->get_module_records();

		$posts = $this->dashboard_admin_model->get_posts_records();
		$posts_no = count( $posts );

		$lang = (array)$this->lang->line('dashboard');
		$page_title = $lang['lang_page_title'];

		if( $page_records_no == 1 ) {
			$page_records_name = $lang['lang_pages_singular'];
		} else {
			$page_records_name = $lang['lang_pages_plural'];
		}

		if( $posts_no == 1 ){
			$post_record_name = $lang['lang_posts_singular'];
		} else {
			$post_record_name = $lang['lang_posts_plural'];
		}

		$content_data = array(
			'pages_no' 					=> $page_records_no,
			'page_record_name'	=> $page_records_name,
			'modules'						=> $modules,
			'posts_no'					=> $posts_no,
			'post_record_name'  => $post_record_name
		);

		$content = $this->parser->parse('dashboard', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content, 'body_footer' );
		$this->parser->parse( 'base_template', $page );
	}
}