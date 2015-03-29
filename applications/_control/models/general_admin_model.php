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
   * Gets all registered users
   * @return array of objects
   */
  function get_all_users(){
    return $this->db->get('ep_admin_users')->result();
  }
}