<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allfiles {

	/* Default files needed for theme */

    public function default_files() {

    	$default = ['base.php', 'body.php', 'footer.php', 'head.php', 'header.php', 'home.php', 'nav.php', 'sidebar_left.php',
    	'sidebar_right.php', 'simple_page_full.php', 'simple_page_sidebar_left.php', 'simple_page_sidebar_right.php', 
        'simple_page_sidebars.php']

    	return $default;
    }

    /* Check files in theme's folder */

    public function check_theme_files($theme_name) {

    	$dir = APPPATH.'/views/'.$theme_name;   // folder route
        $files = array_diff(scandir($dir), array('..', '.')); // removes annoying dots
        $i = 0 ;    // array position 
        foreach($files as $file) {
            if(strpos($file, '.php')){ //checks if string contains substring '.php'
                $php_files[$i] = $file; 
                $i = $i + 1 ;
            }
        }
       return $php_files;

    }

    /* Checks if theme contains default files */

    public function check_if_default_files($default, $php_files) {

        $result = array_diff($default, $php_files); //compares arrays
        return $result;
    }

    /* Copy missing files from default to selected theme */

    public function default_file($result, $theme) {

        foreach($result as $file) {
            //code to select the missing file from default theme 
            copy(APPPATH.'/views/default'.$file, APPPATH.'views/'.$theme.'/'.$file);
        }

    }
}

/* End of file Allfiles.php */