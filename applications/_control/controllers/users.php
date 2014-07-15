<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	function __construct() {
    parent::__construct();

		/* Load Models */
    $this->load->model('users_model');
    $this->load->model('settings_admin_model');

    /* Libraries */
		$this->load->library('email');
  }

  /**
	 *	Users controller
	 */
	function index() {
		$id_user = $this->session->userdata('id_user');
		$users_data = $this->users_model->get_users($id_user);

		$lang = (array)$this->lang->line('users_settings');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'USERS' => $users_data
		);

		$content = $this->parser->parse('users/users', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Account settings
	 * @param  int   $id_user id of current logged in user
	 * @return void
	 */
	function profile($id_user) {
		$user_data = get_logged_user_by_id( $id_user );

		$lang = (array)$this->lang->line('account_settings');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'avatar' 		=> $user_data['avatar'],
			'id_user'		=> $user_data['id_user'],
			'user' 			=> $user_data['user'],
			'fullname' 	=> $user_data['fullname'],
			'email' 		=> $user_data['email']
		);

		$content = $this->parser->parse( 'users/profile', array_merge($content_data, $lang), true );

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Form process from account settings. Redirects to the same page.
	 * @param  int   $id_user id of current logged in user
	 * @return void
	 */
	function profile_process( $id_user ) {
		$user_data['fullname'] = $this->input->post( 'fullname', true );
		$user_data['user'] = $this->input->post( 'user', true );
		$user_data['email'] = $this->input->post( 'email', true );

		define('MB', 1048576);

		if( $_FILES['avatar']['name'] != '' ) {
			$temp = explode('.', $_FILES['avatar']['name']);
			$ext = end($temp);
			$size = $_FILES['avatar']['size'];

			if( ($ext == 'png') || ($ext == 'jpg') || ($ext == 'gif') ){
				if( $_FILES['avatar']['size'] < 1*MB ){
					$upload_path = './uploads/general/account/';
					$file_name = date('ymdsu').md5($user_data['email']).$user_data['user'].'id-'.$id_user;

					$uploaded_file = $upload_path . $file_name . '.' . end($temp);

					move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaded_file);

					$user_data[ 'avatar' ] = 'account/'.$file_name .'.'. end($temp);
				}
			}
		}

		$this->settings_admin_model->update_user_by_id( $user_data, $id_user );
		redirect( '_control.php/users/profile/' . $id_user );
	}

	/**
	 * Allows editing users
	 * @param integer $user_id current user being edited
	 * @return
	 */
	function edit_profile($user_id){
		$user_data = (array) $this->users_model->get_user_data($user_id);

		$lang = (array)$this->lang->line('users_settings');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'id_user'			=> $user_id,
			'user'				=> $user_data['user'],
			'fullname' 		=> $user_data['fullname'],
			'email'				=> $user_data['email'],
			'avatar'			=> $user_data['avatar']
		);

		$content = $this->parser->parse('users/edit_profile', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Form process from account settings. Redirects to the same page.
	 * @param  int   $id_user id of current logged in user
	 * @return void
	 */
	function edit_profile_process( $id_user ) {
		$user_data[ 'fullname' ] = $this->input->post( 'fullname', true );
		$user_data[ 'user' ] = $this->input->post( 'user', true );
		$user_data[ 'email' ] = $this->input->post( 'email', true );

		define('MB', 1048576);

		if( $_FILES['avatar']['name'] != '' ) {
			$temp = explode('.', $_FILES['avatar']['name']);
			$ext = end($temp);
			$size = $_FILES['avatar']['size'];

			if( ($ext == 'png') || ($ext == 'jpg') || ($ext == 'gif') ){
				if( $_FILES['avatar']['size'] < 1*MB ){
					$upload_path = './uploads/general/account/';
					$file_name = date('ymdsu').md5($user_data['email']).$user_data['user'].'id-'.$id_user;

					$uploaded_file = $upload_path . $file_name . '.' . end($temp);

					move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaded_file);

					$user_data[ 'avatar' ] = 'account/'.$file_name .'.'. end($temp);
				}
			}
		}

		$this->settings_admin_model->update_user_by_id( $user_data, $id_user );
		redirect( '_control.php/users/edit_profile/' . $id_user );
	}

	/**
	 * Allows user deleting
	 * @return
	 */
	function user_delete() {
		$id_user = $this->input->post('id_user');
		$this->users_model->delete_user($id_user);
	}

	/**
	 * Allows registering new users
	 * @return
	 */
	function register() {

		$lang = (array)$this->lang->line('user_register');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'added_by' => 'nu'
		);

		$content = $this->parser->parse('users/register', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	function register_process(){
		$data['fullname'] 		= $this->input->post('fullname');
		$data['user'] 				= $this->input->post('user');
		$data['pass'] 				= crypt($this->input->post('password'));
		$data['email'] 				= $this->input->post('email');
		$data['avatar']				= 'account/default.png';

		if($_FILES['avatar']['name'] != ''){
			$new_user_data = (array)$this->users_model->register_user_return($data);

			$temp = explode('.', $_FILES['avatar']['name']);
			$ext = end($temp);
			$size = $_FILES['avatar']['size'];

			if( ($ext == 'png') || ($ext == 'jpg') || ($ext == 'gif') ){
					$upload_path = './uploads/general/account/';

					$file_name = date('ymdsu').md5($new_user_data['email']).$new_user_data['user'].'id-'.$new_user_data['id_user'];

					$uploaded_file = $upload_path . $file_name . '.' . end($temp);

					move_uploaded_file($_FILES['avatar']['tmp_name'], $uploaded_file);

					$new_user_data[ 'avatar' ] = 'account/'.$file_name .'.'. end($temp);

					$this->users_model->update_user($new_user_data);
			}
		} else{
			$this->users_model->register_user($data);
		}

		redirect( '_control.php/users/');
	}

	function create_token($id_user, $user) {
		$token = md5($id_user.$user.date('h:m:s'));

		$this->users_model->insert_token($id_user, $token);
		$user_data = (array) $this->users_model->get_user_data($id_user);
		$this->users_model->send_email($user_data);

		redirect('_control.php/dashboard');
	}

	function reset_password($id_user, $token) {
		$this->users_model->check_reset_activity($id_user);
		$this->users_model->check_token($id_user, $token);
		$this->users_model->reset_null($id_user);


		$lang = (array)$this->lang->line('user_reset');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'nu' => 'nu'
		);

		$content = $this->parser->parse('users/reset', array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	function change_pass($id_user){
		$nwpass = $this->input->post('new_password');
		$cnpass = $this->input->post('confirm_password');

		if($nwpass != $cnpass){redirect('_control/dashboard');}

		$this->users_model->change_pass($id_user, $nwpass);
		redirect('_control.php/dashboard');
	}

	function view_user($id_user){
		$this->users_model->view_user($id_user);
	}

}