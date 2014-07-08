<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
    parent::__construct();

		//html files folder
		$this->folder_name = 'login/';

		//files suffix
		$this->files_suffix = '_login';

		/* Load models and helpers */
		$this->load->helper('login');
		$this->load->helper('form');
		$this->load->model('login_admin_model');
  }

	/**
	 * Login
	 * @return void
	 */
	function index() {

		/* verifies if user is logged in */
		if( session_verif() ) {
			redirect( 'dashboard' );
		}

		$filenames = get_filenames( $this->folder_name, $this->files_suffix );
		$lang = (array)$this->lang->line('login');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'lang_incorrect_login' 	=> $this->lang->line('error_incorrenct_login'),
			'lang_required_input' 	=> $this->lang->line('error_required_input'),
		);

		$top_nav_data = array(
			'lang_main_website'	=> $lang['lang_main_website'],
		);

		$top_nav = $this->parser->parse($filenames[ 'top_nav' ], $top_nav_data, true);
		$content = $this->parser->parse($filenames[ 'content' ], array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', $filenames[ 'body_header' ], $top_nav, 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * Login process. Checks if user passes the login test.
	 * @return void
	 */
	function log_in() {
		$username = mysql_real_escape_string( $this->input->post('user', true) );
		$password = $this->input->post('pass', true);

		$access = $this->login_admin_model->get_access( $username, $password );

		if( ! empty( $access ) ) {
			create_session( $access );
			echo 1;
		} else {
			echo 0;
		}
		
	}

	/**
	 * Logs out the corrent user. Redirects to login page
	 * @return void
	 */
	function log_out() {
		$data = array();

		$this->session->set_userdata( $data );
		$this->session->sess_destroy();

		redirect( '_control.php/login' );
	}
}