<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

	function __construct() {

    parent::__construct();

		//html files folder
		$this->folder_name = 'settings/';

		//files suffix
		$this->files_suffix = '_settings';

		/* ===== MODELS & HELPERS ===== */
		$this->load->model( 'settings_admin_model' );

  }

	/**
	 * General settings page
	 */
	function index() {

		$settings['website_title'] = $this->settings_admin_model->get_setting_by_name( 'website_title' );
		$settings['website_logo'] = $this->settings_admin_model->get_setting_by_name( 'website_logo' );
		$settings['website_copyright'] = $this->settings_admin_model->get_setting_by_name( 'website_copyright' );

		$content_filename = $this->folder_name . 'general' . $this->files_suffix;

		$page_title = $this->lang->line('general_settings_page_title');

		$langs = array(

			'lang_page_title' 						=> $this->lang->line('general_settings_page_title'),
			'lang_website_title'					=> $this->lang->line('general_settings_website_title'),
			'lang_website_logo'						=> $this->lang->line('general_settings_website_logo'),
			'lang_website_copyright'			=> $this->lang->line('general_settings_website_copyright')

		);

		$settings = array_merge( $settings, $langs );

		$content = $this->parser->parse( $content_filename, $settings, true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * general settings process
	 */
	function general_process() {

		$website_title[ 'value' ] = $this->input->post( 'website_title', true );
		$this->settings_admin_model->update_setting( $website_title, 'website_title' );

		$website_logo[ 'value' ] = $this->input->post( 'website_logo' );
		if( $_FILES['website_logo']['name'] != '' ) {

				$basepath = rtrim(BASEPATH, 'system/');
				$path = $basepath . '/uploads/general/';
				echo $path;
				$random = basename($_FILES['website_logo']['name']);
				$path = $path . $random;

				move_uploaded_file($_FILES['website_logo']['tmp_name'], $path);

				$website_logo[ 'value' ] = $random;

				$this->settings_admin_model->update_setting( $website_logo, 'website_logo' );
		}

		$website_copyright[ 'value' ] = $this->input->post( 'website_copyright', true );
		$this->settings_admin_model->update_setting( $website_copyright, 'website_copyright' );

		redirect( '_control.php/settings' );

	}

	/**
	 * Account settings page
	 */
	function account( $id_user ) {

		$user_data = get_logged_user_by_id( $id_user );
		$content_filename = $this->folder_name . 'account' . $this->files_suffix;

		$page_title = $this->lang->line('account_settings_page_title');

		$langs = array(

			'lang_page_title' 			=> $this->lang->line('account_settings_page_title'),
			'lang_required_input' 	=> $this->lang->line('error_required_input'),
			'lang_username'					=> $this->lang->line('account_settings_username_field'),
			'lang_password'					=> $this->lang->line('account_settings_password_field'),

		);

		$user_data = array_merge( $user_data, $langs );

		$content = $this->parser->parse( $content_filename, $user_data, true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * account settings process
	 */
	function account_process( $id_user ) {

		$user_data[ 'user' ] = $this->input->post( 'user', true );

		if ( $this->input->post( 'pass' ) ) {

				$pass = $this->input->post( 'pass', true );
				$user_data[ 'pass' ] = md5($pass);

		}

		if( $this->settings_admin_model->update_user_by_id( $user_data, $id_user ) ) {

			redirect( '_control.php/settings/account/' . $id_user );

		}

	}

	/**
	 * Modules settings page
	 */
	function modules() {

		$content_filename = $this->folder_name . 'modules' . $this->files_suffix;

		$page_title = $this->lang->line('modules_settings_page_title');

		$content_data = array(

			'lang_page_title' 	=> $this->lang->line('modules_settings_page_title'),
			'lang_contruction' 	=> $this->lang->line('misc_construction')

		);

		$content = $this->parser->parse( $content_filename, $content_data, true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * Theme settings page
	 */
	function theme() {

		$themes = $this->settings_admin_model->get_themes();

		$content_filename = $this->folder_name . 'theme' . $this->files_suffix;

		$page_title = $this->lang->line('theme_settings_page_title');

		$content_data = array(

			'lang_page_title' 	=> $this->lang->line('theme_settings_page_title'),
			'THEMES'						=> $themes,
			'lang_content_type_field' =>$this->lang->line('theme_settings_content'),
			'lang_submit_form'  => $this->lang->line('theme_select'),
		);

		$content = $this->parser->parse( $content_filename, $content_data, true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * theme settings procces
	 */
	function theme_process(){

		$id_selected_theme = $this->input->post('themes');

		$themes = $this->settings_admin_model->get_themes();

		foreach($themes as $theme){

			$theme->active = '0';

			$this->settings_admin_model->update_theme_settings( $theme, $theme->id_theme );
		
		}
		
		$selected_theme = $this->settings_admin_model->get_theme_by_id($id_selected_theme);

		$selected_theme->active = '1';

		$this->settings_admin_model->update_theme_settings($selected_theme, $id_selected_theme);

		$content_filename = $this->folder_name . 'theme' . $this->files_suffix;

		$page_title = $this->lang->line('theme_settings_page_title');

		$content_data = array(

			'lang_page_title' 	=> $this->lang->line('theme_settings_page_title'),
			'THEMES'						=> $themes,
			'lang_content_type_field' =>$this->lang->line('theme_settings_content'),
			'lang_submit_form'  => $this->lang->line('theme_select'),
		);

		$content = $this->parser->parse( $content_filename, $content_data, true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * view theme 
	 */
	function theme_view(){

	}

}

/* End of file settings.php */
/* Location: ./applications/_control/controllers/settings.php */