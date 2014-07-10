<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {
	function __construct() {
    parent::__construct();

		//html files folder
		$this->folder_name = 'settings/';

		//files suffix
		$this->files_suffix = '_settings';

		/* Load Models */
		$this->load->model( 'settings_admin_model' );
		$this->load->model('pages_model');
		$this->load->model('themes_model');
		$this->load->model('modules_model');
  }

	/**
	 * General settings
	 * @return void
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

		$lang = (array)$this->lang->line('general_settings');
		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'PAGES' => $pages,
		);

		$content = $this->parser->parse($content_filename, array_merge($content_data, $settings, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Form process from general settings. Redirects to the same page.
	 * @return void
	 */
	function general_process() {
		$website_title[ 'value' ] = $this->input->post( 'website_title', true );
		$this->settings_admin_model->update_setting( $website_title, 'website_title' );

		$website_homepage[ 'value' ] = $this->input->post('website_homepage', true);
		$this->settings_admin_model->update_setting($website_homepage, 'website_homepage');

		$website_logo[ 'value' ] = $this->input->post( 'website_logo' );
		if( $_FILES['website_logo']['name'] != '' ) {

			//$basepath = rtrim(BASEPATH, 'system/');
			//$path = $basepath . '/uploads/general/';
			$path = './uploads/general/settings/';
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
	 * Modules settings
	 * @return void
	 */
	function modules() {

		$this->refresh_modules();
		$content_filename = $this->folder_name . 'modules' . $this->files_suffix;
		$lang = (array)$this->lang->line('modules_settings');
		$page_title = $lang['lang_page_title'];

		$modules = $this->modules_model->get_modules();

		$content_data = array(
			'MODULES' => $modules,
		);

		$content = $this->parser->parse( $content_filename, array_merge($content_data, $lang), true );

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Searches if new modules have been added and if so,
	 * adds the name of the module in the database.
	 * @return void
	 */
	public function refresh_modules() {
		$dir = './applications/_control/modules';
		$folders = array_diff(scandir($dir), array('..', '.'));

		$modules_in_db = $this->modules_model->get_modules();
		$modules_slugs = array();
		foreach($modules_in_db as $key => $module) {
			$modules_slugs[$key] = $module->module_slug;
		}

		$modules_to_add = array_diff($folders, $modules_slugs);
		$this->modules_model->delete_modules();

		$modules = array();
		foreach($folders as $key => $folder_name) {
			if(strpos($folder_name, '_')) {
				$module_name = str_replace('_', ' ', $folder_name);
				$module_name = ucfirst($module_name);
			} else {
				$module_name = ucfirst($folder_name);
			}

			$this->modules_model->insert_module($module_name, $folder_name);
		}
	}

	/**
	 * Deletes a module with all the files and folders.
	 * Redirects to the same page
	 * @return void
	 */
	function module_delete() {
		$id_module = $this->input->post('id_module');
		$module = $this->modules_model->get_module_by_id($id_module);
		delete_directory('./applications/_control/modules/' . $module->module_slug);
		$this->modules_model->delete_module($id_module);
		redirect('_control.php/settings/modules');
	}

	/**
	 * Theme settings
	 * @return void
	 */
	function theme() {
		$this->refresh_themes();
		$lang = (array)$this->lang->line('theme_settings');

		$themes = $this->settings_admin_model->get_themes();
		foreach( $themes as $theme ) {
			if( $theme->active == '1' ) {
				$theme->selected = "blueBtn";
				$theme->lang_verb = $lang['lang_enabled'];
			} else {
				$theme->selected = "";
				$theme->lang_verb = $lang['lang_enable'];
			}
		}

		$content_filename = $this->folder_name . 'theme' . $this->files_suffix;

		$page_title = $lang['lang_page_title'];

		$content_data = array(
			'THEMES' => $themes,
		);

		$content = $this->parser->parse($content_filename, array_merge($content_data, $lang), true);

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Form process from theme settings. Redirects to the same page.
	 * @return void
	 */
	function theme_process(){

		$id_selected_theme = $this->input->post('id_theme');
		$themes = $this->settings_admin_model->get_themes();

		foreach($themes as $theme){
			$theme->active = '0';
			$this->settings_admin_model->update_theme_settings( $theme, $theme->id_theme );
		}

		if($id_selected_theme != '0') {
			$selected_theme = $this->settings_admin_model->get_theme_by_id($id_selected_theme);
			$selected_theme->active = '1';
			$this->settings_admin_model->update_theme_settings($selected_theme, $id_selected_theme);
		}
		redirect('_control.php/settings/theme');
	}

	function theme_delete() {
		$id_theme = $this->input->post('id_theme');
		$theme = $this->themes_model->get_theme_by_id($id_theme);
		delete_directory('./applications/client/views/' . $theme['name'] . '_theme');

		$this->themes_model->delete_theme($id_theme);
	}

	/**
	 * Searches for new themes and if found,
	 * adds them to the database.
	 * @return void
	 */
	public function refresh_themes(){
		$dir = './applications/client/views';
		$i = 0;
		$folders = scandir($dir);
		$themesDB = array();
		foreach($folders as $folder){
			if(strpos($folder, '_theme')){
				$folder = substr($folder, 0, -6);
				$themesDB[$i] = $folder; //put themes who must go in database in array
				$i++;
			}
		}

		//get themes from database
		$themes_exist = $this->settings_admin_model->get_themes();
		$j = 0;
		$name = array();
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
	}

}