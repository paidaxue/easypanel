<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allfiles {

	/* Default files needed for theme */

    public function default_files()
    {
    	$default = ['base.php', 'body.php', 'footer.php', 'head.php', 'header.php', 'home.php', 'nav.php', 'sidebar_left.php',
    	'sidebar_right.php', 'simple_page_full.php', 'simple_page_sidebar_left.php', 'simple_page_sidebar_right.php', 'simple_page_sidebars.php'
    	]

    	return $default;
    }

    /* Check files in theme's folder */

    public function check_files() {

    	$this->load->helper('url');

    	$dir = site_url('client');

    }
}

/* End of file Allfiles.php */