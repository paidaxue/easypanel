<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

  /**
   * Get homepage
   * @return object containing the homepage
   */
  function get_homepage () {
    $page_id = $this->db->get_where('ep_admin_settings', array('name' => 'website_homepage'))->row()->value;
    return $this->db->get_where('ep_pages', array('id_page' => $page_id))->row();
  }

  /**
   * Get page by page_slug
   * @return object page itself
   */
  function get_page_by_page_slug( $page_slug ) {
    return $this->db->get_where('ep_pages', array('page_slug' => $page_slug))->row();
  }

  /**
   * Get parent pages
   * @return array all parents
   */
  function get_parents () {
    $this->db->where('page_type', 'parent');
    $this->db->or_where('page_type', 'parent-no-link');
    return $this->db->get('ep_pages')->result();
  }

  /**
   * Get children pages
   * @return object children of a specific page
   */
  function get_children( $id_page ) {
    return $this->db->get_where('ep_pages', array('page_type' => $id_page))->result();
  }

  /**
   * Get current theme name
   * @return string current theme name
   */
  function get_active_theme() {
    $active_theme = $this->db->get_where('ep_themes', array('active' => '1'))->row();
    return $active_theme ? $active_theme->name : 'default';
  }

  /**
   * Get sidebar by id
   * @return object a specific sidebar
   */
  function get_sidebar_by_id($id) {
    return $this->db->get_where('ep_sidebars', array('id_sidebar' => $id))->row();
  }

  /**
   * Get website setting by name
   * @return object a website setting
   */
  function get_website_setting_by_name($name) {
    return $this->db->get_where('ep_admin_settings', array('name' => $name))->row();
  }
}

/* End of file main_model.php */
/* Location: ./applications/client/models/main_model.php */
