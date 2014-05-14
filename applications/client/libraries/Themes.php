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

    $nav = $this->CI->main_model->get_parents();

    foreach($nav as $menu) {
      $chs = $this->CI->main_model->get_children($menu->id_page);

      if ( ! empty( $chs ) ) {
        foreach ( $chs as $kid ) {
          $kid->s_page_link = site_url() . 'page' . '/' . $kid->page_slug;
          $kid->s_title = $kid->title;
        }

        $menu->S_NAV = $chs;
      } else {
        $menu->S_NAV = array();
      }

      $homepage = $this->CI->main_model->get_homepage();

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
		return $this->CI->main_model->get_website_setting_by_name('website_copyright');
  }

	/**
	 * Builds the template
	 * @return array with parsed data
	 */
	public function build_template($data, $layout_type, $right_sidebar = '0', $left_sidebar = '0') {
		// building head...
    $head_data = array(
      'page_title' => $data['page_title']
    );

    // building header...
    $header_data = array(
      'page_title' => $data['page_title']
    );

		// building nav...
    $nav_data = array(
      'NAV' => $this->build_nav()
    );

    // building content...
    $content_data = array(
      'content' => $data['page_content']
    );

    // building footer...
    $nav_data = array(
      'copyright' => $this->build_footer()
    );

    // building main content...
    if($layout_type == 'both') {
    	$right_sidebar = $this->main_model->get_sidebar_by_id($right_sidebar);
    	$left_sidebar = $this->main_model->get_sidebar_by_id($left_sidebar);
    	$sidebars_data = array(
    		'right_sidebar' => $right_sidebar,
    		'left_sidebar' => $left_sidebar,
    	);
    } elseif ($layout_type == 'left') {
    	$left_sidebar = $this->main_model->get_sidebar_by_id($left_sidebar);
    	$left_sidebar_data = array(
    		'left_sidebar' => $left_sidebar,
    	);
    } elseif ($layout_type == 'right') {
    	$right_sidebar = $this->main_model->get_sidebar_by_id($right_sidebar);
    	$right_sidebar_data = array(
    		'right_sidebar' => $right_sidebar,
    	);
    }

    // parsing data...
    $theme_files = $this->get_theme_files();
    foreach($theme_files as $index => $file) {
    	if(strstr($file, 'head.php')) {
    		$view['HEAD'] = $this->parser->parse( $file, $head_data, true );
    	} elseif (strstr($file, 'header.php')) {
    		$header = $this->parser->parse( $file, $head_data, true );
    	} elseif (strstr($file, 'nav.php')) {
    		$nav = $this->parser->parse( $file, $head_data, true );
    	} elseif (strstr($file, 'footer.php')) {
    		$footer = $this->parser->parse( $file, $head_data, true );
    	}

    	if($layout_type == 'both') {
	    	if(strstr($file, 'sidebar_right.php')) {
	    		$right_sidebar = $this->parser->parse( $file, $right_sidebar, true );
	    	}

				if(strstr($file, 'sidebar_left.php')) {
	    		$left_sidebar = $this->parser->parse( $file, $left_sidebar, true );
	    	}

	    	if(strstr($file, 'simple_page_sidebars.php')) {
	    		$data = array_merge($sidebars_data, $content_data);
	    		$main = $this->parser->parse( $file, $data, true );
	    	}
	    } elseif ($layout_type == 'left') {
	    	if(strstr($file, 'sidebar_left.php')) {
	    		$left_sidebar = $this->parser->parse( $file, $left_sidebar, true );
	    	}

	    	if(strstr($file, 'simple_page_sidebar_left.php')) {
	    		$data = array_merge($left_sidebar_data, $content_data);
	    		$main = $this->parser->parse( $file, $data, true );
	    	}
	    } elseif ($layout_type == 'right') {
				if(strstr($file, 'sidebar_right.php')) {
	    		$right_sidebar = $this->parser->parse( $file, $right_sidebar, true );
	    	}

	    	if(strstr($file, 'simple_page_sidebar_right.php')) {
	    		$data = array_merge($right_sidebar_data, $content_data);
	    		$main = $this->parser->parse( $file, $data, true );
	    	}
	    } elseif ($layout_type == 'none') {
	    	if(strstr($file, 'simple_page_full.php')) {
	    		$main = $this->parser->parse( $file, $content_data, true );
	    	}
	    }

	    if(strstr($file, 'body.php')) {
	    	// build body...
		    $body_data = array(
		    	'HEADER'    => $header,
		      'NAV'       => $nav,
		      'MAIN'      => $main,
		      'FOOTER'    => $footer
		    );

		    $view['BODY'] = $this->parser->parse( $file, $body_data, true );
	    }
    }

    return $view;
	}

	/**
	 * Gets directory of base file
	 * @return string base directory
	 */
	public function get_base() {
		$theme_files = $this->get_theme_files();
    foreach($theme_files as $file) {
    	if(strstr($file, 'base.php')) {
    		return $file;
    	}
    }
	}
}