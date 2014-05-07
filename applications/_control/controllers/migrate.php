<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('migration');
  }

  /**
   * Alters the database to the last migration. Only accesible by CLI
   */
  function latest() {
    if (!$this->input->is_cli_request()) {
      die('This is only accessible from the CLI.');
    }

    if (!$this->migration->latest())
    {
      echo $this->migration->error_string();
    }
    else {
      echo "Database succesfully migrated to the latest version.\n";
    }
  }

  /**
   * Alters the database to a specific version. Only accesible by CLI
   */
  function version ($version) {
    if (!$this->input->is_cli_request()) {
      die('This is only accessible from the CLI.');
    }

    if (!is_numeric($version)) {
      echo 'ERROR: Version must be a number.';
    }

    if (!$this->migration->version($version)) {
      echo $this->migration->error_string();
    } else {
      echo "Database succesfully migrated to the version {$version}.\n";
    }
  }

  /**
   * Creates the database and builds the basic structure
   */
  function build () {
    if (!$this->migration->version(1)) {
      echo $this->migration->error_string();
    } else {
      echo "Structure created.\n";
    }
  }
}