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
		$this->CI->load->library('parser');
  }

	/**
	 * Check files in theme's folder
	 * @return array files that are in current active theme
	 */
	public function get_theme_files($module = false, $module_view_folder = false) {
		if(!$module) {
      $default = array(
  			'base.php',
  			'footer.php',
  			'header.php',
  			'nav.php',
        'home.php',
        'page.php',
  			'sidebar_left.php',
  			'sidebar_right.php',
  		);
    } else {
      $default = array(
        'base.php',
        'footer.php',
        'header.php',
        'nav.php',
        'sidebar_left.php',
        'sidebar_right.php',
      );
    }
		$regex_1='.*?';	# Non-greedy match on filler
  	$regex_2='((?:[a-z][a-z\\.\\d_]+)\\.(?:[a-z\\d]{3}))(?![\\w\\.])';	# File Name 1
		$dir = APPPATH . 'views/' . $this->active_theme; // folder route
		$files = array_diff(scandir($dir), array('..', '.')); // removes annoying dots
		$fallback = array_diff($default, $files);

		// gets existing files in current theme folder
		foreach($files as $key => $file) {
			if(strpos($file, '.php')){ // checks if string contains substring '.php'
				$existing_files_values[$key] = $this->active_theme . '/' . $file;
				$matches = array();
				preg_match_all("/".$regex_1.$regex_2."/is", $file, $matches); // regex for filename
				$existing_files_keys[$key] = $matches[1][0];
			}
		}

		$existing_files = array_combine($existing_files_keys, $existing_files_values);

		// builds fallback files
		foreach($fallback as $key => $file) {
			if(strpos($file, '.php')){ // checks if string contains substring '.php'
				$fallback_files_values[$key] = 'default/' . $file;
				$matches = array();
				preg_match_all("/".$regex_1.$regex_2."/is", $file, $matches); // regex for filename
				$fallback_files_keys[$key] = $matches[1][0];
			}
		}

		if(!empty($fallback)) {
      $fallback_files = array_combine($fallback_files_keys, $fallback_files_values);
			$theme_files = array_merge($existing_files, $fallback_files);
		} else {
			$theme_files = $existing_files;
		}

    if(!$module_view_folder) {
      $module_view_folder = $module . '_view';
    }

    if($module) {
      $dir = APPPATH . 'modules/' . $module . '/' . 'views/' . $module_view_folder;
      $files = array_diff(scandir($dir), array('..', '.')); // removes annoying dots

      foreach($files as $key => $file) {
        $module_files_values[$key] = $module_view_folder . '/' . $file;
        $matches = array();
        preg_match_all("/".$regex_1.$regex_2."/is", $file, $matches); // regex for filename
        $module_files_keys[$key] = $matches[1][0];
      }

      $module_files = array_combine($module_files_keys, $module_files_values);
      $theme_files = array_merge($theme_files, $module_files);
    }

	  return $theme_files;
	}

	/**
	 * Builds the main navigation
	 * @return array of objects
	 */
	function build_nav() {

    $nav = $this->CI->main_model->get_parents();

    foreach($nav as $menu) {
      $chs = $this->CI->main_model->get_children($menu->id_page);

      if ( ! empty( $chs ) ) {
        foreach ( $chs as $kid ) {
          $kid->s_page_link = site_url() . $kid->module . '/' . $kid->page_slug;
          $kid->s_title = $kid->title;
        }

        $menu->S_NAV = $chs;
      } else {
        $menu->S_NAV = array();
      }

      if($this->CI->uri->segment(2) == $menu->page_slug) {
        $menu->active = 'active';
      } else {
        $menu->active = '';
      }

      $homepage = $this->CI->main_model->get_homepage();

      if ( $menu->id_page == $homepage->id_page ) {
        $menu->page_link = site_url();
      } elseif( $menu->page_type == 'parent-no-link' ) {
        $menu->page_link = '#';
      } else {
        $menu->page_link = site_url() . $menu->module . '/' . $menu->page_slug;
      }
    }

    return $nav;
  }

  /**
	 * Builds the footer
	 * @return string website copyright
	 */
	function build_footer() {
		return $this->CI->main_model->get_website_setting_by_name('website_copyright')->value;
  }

	/**
	 * Builds the template
	 * @return array with parsed data
	 */
	public function build_template($data, $sidebars, $homepage = false, $module = false, $module_view_folder = false) {
    $right_sidebar = (isset($sidebars['right_sidebar'])) ? $sidebars['right_sidebar'] : 0;
    $left_sidebar = (isset($sidebars['left_sidebar'])) ? $sidebars['left_sidebar'] : 0;

    // building header...
    $header_data = array(
      'page_title' => $data['page_title'],
    );

		// building nav...
    $nav_data = array(
      'NAV' => $this->build_nav(),
    );

    // building content...
    if(isset($data['page_content'])) {
      $content_data = array(
        'content' => $data['page_content'],
      );
    } else {
      $content_data = array();
    }

    if(isset($data['page_data'])) {
      $content_data = array_merge($content_data, $data['page_data']);
    }

    // building footer...
    $footer_data = array(
      'copyright' => $this->build_footer(),
      'current_year' => date("Y"),
    );

    // building main content...
  	$right_sidebar_info = $this->CI->main_model->get_sidebar_by_id($right_sidebar);
  	$left_sidebar_info = $this->CI->main_model->get_sidebar_by_id($left_sidebar);
  	$right_sidebar_data = array(
  		'right_sidebar_content' => (!empty($right_sidebar_info->content)) ? $right_sidebar_info->content : '',
  	);
  	$left_sidebar_data = array(
  		'left_sidebar_content' => (!empty($left_sidebar_info->content)) ? $left_sidebar_info->content : '',
  	);

    // parsing data...
    if($module) {
      $theme_files = $this->get_theme_files($module, $module_view_folder);
    } else {
      $theme_files = $this->get_theme_files();
    }

		$header = $this->CI->parser->parse( $theme_files['header.php'], $header_data, true );
		$nav = $this->CI->parser->parse( $theme_files['nav.php'], $nav_data, true );
		$footer = $this->CI->parser->parse( $theme_files['footer.php'], $footer_data, true );

		$right_sidebar = $this->CI->parser->parse( $theme_files['sidebar_right.php'], $right_sidebar_data, true );
		$left_sidebar = $this->CI->parser->parse( $theme_files['sidebar_left.php'], $left_sidebar_data, true );
		$sidebar_data = array_merge(array('right_sidebar' => $right_sidebar, 'left_sidebar' => $left_sidebar), $content_data);
		$main = $this->CI->parser->parse( $theme_files['page.php'], $sidebar_data, true );

    if($homepage){
      $main = $this->CI->parser->parse( $theme_files['home.php'], $sidebar_data, true );
    }

    $view['page_title'] = $data['page_title'];

    $view['HEADER'] = $header;
    $view['NAV']    = $nav;
    $view['MAIN']   = $main;
    $view['FOOTER'] = $footer;

    return $view;
	}

	/**
	 * Gets directory of base file
	 * @return string base directory
	 */
	public function get_base() {
		$theme_files = $this->get_theme_files();
    return $theme_files['base.php'];
	}
}