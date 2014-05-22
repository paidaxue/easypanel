<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class General_admin_model extends CI_Model {

	/**
	 * Gets logged user
   * @return array current logged user
	 */
	function logged_user( $id_user ) {
		return $this->db->get_where('ep_admin_users', array('id_user' => $id_user))->row_array();
	}

  /**
   * Gets all the modules
   * @return object all modules
   */
  function get_modules() {
    return $this->db->get_where('ep_modules', array('module_slug !=' => 'simple_page'))->result();
  }

  /**
   * Get module by id
   * @return object all modules
   */
  function get_module_by_id($id_module) {
    return $this->db->get_where('ep_modules', array('id_module' => $id_module))->row();
  }

  /**
   * Insert module
   * @return object all modules
   */
  function insert_module($name, $module_slug) {
    return $this->db->insert('ep_modules', array('name' => $name, 'module_slug' => $module_slug));
  }

  /**
   * Deletes all modules except simple_page
   * @return query executes mysql query
   */
  function delete_modules() {
    return $this->db->delete('ep_modules', array('module_slug !=' => 'simple_page'));
  }

  /**
   * Deleted a specific model
   * @return query executes mysql query
   */
  function delete_module($id_module) {
    return $this->db->delete('ep_modules', array('id_module' => $id_module));
  }
}

/* End of file general_admin_model.php */
/* Location: ./applications/_control/models/general_admin_model.php */