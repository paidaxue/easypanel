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
   * Deleted a specific model
   */
  function delete_module($id_module) {
    return $this->db->delete('ep_modules', array('id_module' => $id_module));
  }
}

/* End of file general_admin_model.php */
/* Location: ./applications/_control/models/general_admin_model.php */