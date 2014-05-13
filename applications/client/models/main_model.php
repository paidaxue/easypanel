<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

  public function __construct() {

    parent::__construct();

  }

  /**
    * Get homepage
    */
  function get_homepage () {

    $page_id = $this->db->get_where('ep_admin_settings', array('name' => 'website_homepage'))->row()->value;
    return $this->db->get_where('ep_pages', array('id_page' => $page_id))->row();

  }

  /**
    * Get page content by module
    */
  function get_page_by_module ( $module ) {

    return $this->db->get_where('ep_pages', array('module' => $module))->row();

  }

  /**
    * Get page content by page_slug
    */
  function get_page_by_page_slug ( $page_slug ) {

    return $this->db->get_where('ep_pages', array('page_slug' => $page_slug))->row();

  }

  /**
    * Get parent pages
    * @return array of objects
    */
  function get_parents () {

    $parents_with_link = $this->db->get_where('ep_pages', array('page_type' => 'parent'))->result();
    $parents_no_link = $this->db->get_where('ep_pages', array('page_type' => 'parent-no-link'))->result();
    $parents = array_merge($parents_with_link, $parents_no_link);

    return $parents;

  }

  /**
    * Get children pages
    * @return array of objects
    */
  function get_children ( $id_page ) {

    return $this->db->get_where('ep_pages', array('page_type' => $id_page))->result();

  }

}

/* End of file main_model.php */
/* Location: ./applications/client/models/main_model.php */
