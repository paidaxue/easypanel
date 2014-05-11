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
		$this->load->model('pages_model');

  }

	/**
	 * General settings page
	 */
	function index() {

		$settings['website_title'] = $this->settings_admin_model->get_setting_by_name( 'website_title' );
		$settings['website_logo'] = $this->settings_admin_model->get_setting_by_name( 'website_logo' );
		$settings['website_copyright'] = $this->settings_admin_model->get_setting_by_name( 'website_copyright' );
		$settings['website_homepage'] = $this->settings_admin_model->get_setting_by_name( 'website_homepage' );

		$pages = $this->pages_model->get_all_pages();

		foreach( $pages as $homepage ){

			if ( $homepage->id_page == $settings['website_homepage'] ) {

				$homepage->selected = "selected='selected'";

			} else {

				$homepage->selected = "";

			}

		}

		$content_filename = $this->folder_name . 'general' . $this->files_suffix;

		$page_title = $this->lang->line('general_settings_page_title');

		$content_data = array(

			'PAGES'						=> $pages,
		);

		$langs = array(

			'lang_page_title' 						=> $this->lang->line('general_settings_page_title'),
			'lang_website_title'					=> $this->lang->line('general_settings_website_title'),
			'lang_website_logo'						=> $this->lang->line('general_settings_website_logo'),
			'lang_website_copyright'			=> $this->lang->line('general_settings_website_copyright'),
			'lang_website_homepage'       => $this->lang->line('general_settings_website_homepage')

		);

		$homepage = array_merge($content_data, $langs);

		$settings = array_merge( $settings, $homepage );

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

		$website_homepage[ 'value' ] = $this->input->post('website_homepage', true);
		$this->settings_admin_model->update_setting($website_homepage, 'website_homepage');

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
		foreach( $themes as $theme ) {
			if( $theme->active == '1' ) {
				$theme->selected = "selected = 'selected'";
			} else {
				$theme->selected = "";
			}
		}

		$content_filename = $this->folder_name . 'theme' . $this->files_suffix;

		$page_title = $this->lang->line('theme_settings_page_title');

		$content_data = array(

			'lang_page_title' 	=> $this->lang->line('theme_settings_page_title'),
			'THEMES'						=> $themes,
			'lang_content_type_field' =>$this->lang->line('theme_settings_content'),
			'lang_submit_form'  => $this->lang->line('theme_submit'),
			'lang_refresh_themes'  => $this->lang->line('theme_refresh_themes'),
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

		redirect('_control.php/settings/theme');

	}

	/**
	 * refresh themes list
	 */
	function refresh_themes(){
		$loc = base_url(); 
		$local = str_replace( "http://localhost/dev.easypanel/", "", $loc );
		$dir = $local.'applications/client/views';
		$i = 0;
		$folders = scandir($dir);
		foreach($folders as $folder){
			if(strpos($folder, '_theme')){
				$themesDB[$i] = $folder; //put themes who must go in database in array
				$i++;
			}
		}

		//get themes from database	
		$themes_exist = $this->settings_admin_model->get_themes();
		$j = 0;
		foreach($themes_exist as $theme_exist){
			$name[$j] = $theme_exist->name;
			$j++;
		}
  
    // verified who is not in database and exist in folder
		$dif1 = array_diff($themesDB, $name);
		$k = 0;
		$count = 0;
		foreach ($dif1 as $dif) {
			$different[$k] = $dif;
			$k++; 
			$count++;
		}

		//if exist new theme in folder, put it in database else stay on that page
		if($count > 0){
			foreach ($different as $diff) {
				$theme_to_DB['name'] = $diff;
				$theme_to_DB['active'] = '0';

				$this->settings_admin_model->insert_theme($theme_to_DB);
			}
		}

		//verified who theme is not folder and is in data base
		$dif2 = array_diff($name, $themesDB);
		$n = 0;
		$count1 = 0;
		foreach ($dif2 as $diff2) {
			$different1[$n] = $diff2;
			$n++;
			$count1++;
		}

		//get theme in database by_name
		//if exsit theme in database who don't exist in folder, delete them all
		if($count1 > 0){
			foreach ($different1 as $diff3) {
				$theme_delete['name'] = $diff3;

				$this->settings_admin_model->delete_theme($theme_delete);
			}
		}
		redirect('_control.php/settings/theme');
	}

}

/* End of file settings.php */
/* Location: ./applications/_control/controllers/settings.php */