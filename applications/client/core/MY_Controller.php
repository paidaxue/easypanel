<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  function __construct() {
    parent::__construct();

    $this->load->model('main_model');
    $this->theme = $this->main_model->get_active_theme();

    $this->load->library('Themes', array('theme' => $this->theme));
  }
}

/* End of file MY_Controller.php */
/* Location: ./applications/client/controllers/MY_Controller.php */