<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
    parent::__construct();

		/* Load models and helpers */
		$this->load->model('login_m');
  }

	function index() {
		/* verifies if user is logged in */
		if( session_verif() ) {
			redirect('_control.php/dashboard');
		}

		$lang = (array)$this->lang->line('login');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'lang_incorrect_login' 	=> $this->lang->line('error_incorrenct_login'),
			'lang_required_input' 	=> $this->lang->line('error_required_input'),
		);

		$top_nav_data = array(
			'lang_main_website'	=> $lang['lang_main_website'],
		);

		$top_nav = $this->parser->parse('login/top_nav_login', $top_nav_data, true);
		$content = $this->parser->parse('login/content_login', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'login/body_header_login', $top_nav, 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Login process. Checks if user passes the login test.
	 * @return void
	 */
	function log_in() {
		$username = mysql_real_escape_string( $this->input->post('user', true) );
		$password = $this->input->post('pass', true);

		$access = $this->login_m->get_access( $username, $password );

		if(!empty($access)) {
			$this->create_session($access);
			echo 1;
		} else {
			echo 0;
		}
	}

 	public function create_session($user) {
    $session_data = array(
      'id_user'   => $user->id_user,
      'username'  => $user->user,
      'avatar'    => $user->avatar,
      'full_name' => $user->fullname,
      'inside'    => true,
    );

    $this->session->set_userdata($session_data);
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