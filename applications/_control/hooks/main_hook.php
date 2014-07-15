<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_hook {

	/**
	 * making parsed urls
	 */
	public function urls() {

		$CI =& get_instance();
 	  $this->output = & $CI->output;
  	$output = $this->output->get_output();

    $base_url = base_url() . '_control.php';
    $app_url = base_url() . 'applications/_control';
    $up_url = base_url() . 'uploads';

    $output = str_replace('{BASE_URL}', $base_url, $output);
    $output = str_replace('{APP_URL}', $app_url, $output);
    $output = str_replace('{UP_URL}', $up_url, $output);

		$this->output->set_output($output);

	}

	/**
	 * cleaning page title
	 */
	public function cleaning() {

		$CI =& get_instance();
    $this->output = & $CI->output;
    $output = $this->output->get_output();

		$output = str_replace('{TITLE}','',$output);

		$this->output->set_output($output);

	}

	/**
	 * logged user info
	 */
	public function user_info() {

		$CI =& get_instance();
    $this->output = & $CI->output;
    $output = $this->output->get_output();

		$output = str_replace('{loggedUser}',$CI->session->userdata('username'),$output);
    $output = str_replace('{id_loggedUser}',$CI->session->userdata('id_user'),$output);
		$output = str_replace('{active_avatar}',$CI->session->userdata('avatar'),$output);

		$this->output->set_output($output);

	}

}

/* End of file main_hook.php */
/* Location: ./applications/_control/hooks/main_hook.php */
