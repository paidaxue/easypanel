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

		$users = $this->dashboard_admin_model->get_users_records();
		$users_no = count( $users );

		$lang = (array)$this->lang->line('dashboard');
		$page_title = $lang['lang_page_title'];

		if( $page_records_no == 1 ) {
			$page_records_name = $lang['lang_pages_singular'];
		} else {
			$page_records_name = $lang['lang_pages_plural'];
		}

		if( $users_no == 1 ){
			$users_record_name = $lang['lang_users_singular'];
		} else {
			$users_record_name = $lang['lang_users_plural'];
		}

		$content_data = array(
			'pages_no' 					=> $page_records_no,
			'page_record_name'	=> $page_records_name,
			'modules'						=> $modules,
			'users_no'					=> $users_no,
			'users_record_name' => $users_record_name
		);

		$content = $this->parser->parse('dashboard', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content, 'body_footer' );
		$this->parser->parse( 'base_template', $page );
	}
}