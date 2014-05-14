<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes {
	public function __construct($params) {
		if($params['theme'] == 'default') {
			$this->active_theme = $params['theme'];
		} else {
			$this->active_theme = $params['theme'] . '_theme';
		}

		$this->CI =& get_instance();
		$this->CI->load->model('main_model');
  }

	/**
	 * Check files in theme's folder
	 * @return array files that are in current active theme
	 */
	public function get_theme_files() {
		$default = [
			'base.php',
			'body.php',
			'footer.php',
			'head.php',
			'header.php',
			'home.php',
			'nav.php',
			'sidebar_left.php',
			'sidebar_right.php',
			'simple_page_full.php',
			'simple_page_sidebar_left.php',
			'simple_page_sidebar_right.php',
			'simple_page_sidebars.php'
		];
		$dir = APPPATH . 'views/' . $this->active_theme; // folder route
		$files = array_diff(scandir($dir), array('..', '.')); // removes annoying dots
		$fallback = array_diff($default, $files);

		// gets existing files in current theme folder
		foreach($files as $key => $file) {
			if(strpos($file, '.php')){ // checks if string contains substring '.php'
				$existing_files[$key] = $this->active_theme . '/' . $file;
			}
		}

		// builds fallback files
		foreach($fallback as $key => $file) {
			if(strpos($file, '.php')){ // checks if string contains substring '.php'
				$fallback_files[$key] = 'default/' . $file;
			}
		}

		if(!empty($fallback_files)) {
			$theme_files = array_merge($existing_files, $fallback_files);
		} else {
			$theme_files = $existing_files;
		}

	  return $theme_files;
	}

	/**
	 * Builds the main navigation
	 * @return array of objects
	 */
	function build_nav() {

    $nav = $this->main_model->get_parents();

    foreach($nav as $menu) {
      $chs = $this->main_model->get_children($menu->id_page);

      if ( ! empty( $chs ) ) {
        foreach ( $chs as $kid ) {
          $kid->s_page_link = site_url() . 'page' . '/' . $kid->page_slug;
          $kid->s_title = $kid->title;
        }

        $menu->S_NAV = $chs;
      } else {
        $menu->S_NAV = array();
      }

      $homepage = $this->main_model->get_homepage();

      if ( $menu->id_page == $homepage->id_page ) {
        $menu->page_link = site_url();
      } elseif( $menu->page_type == 'parent-no-link' ) {
        $menu->page_link = '#';
      } else {
        $menu->page_link = site_url() . 'page' . '/' . $menu->page_slug;
      }
    }

    return $nav;
  }

  /**
	 * Builds the footer
	 * @return string website copyright
	 */
	function build_footer() {
		return $this->main_model->get_website_setting_by_name('website_copyright');
  }

	/**
	 * Builds the template
	 * @return array with parsed data
	 */
	public function build_template($data, $layout_type, $right_sidebar = '0', $left_sidebar = '0') {
		# code...
	}
}