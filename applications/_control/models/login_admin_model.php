<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_admin_model extends CI_Model {

	/**
	 * Returns the user for login
	 */
	function get_access( $username, $password ) {
		$this->db->where('user', $username);
		$query = $this->db->get('ep_admin_users')->row();

		$current_password = $query->pass;

		if(crypt($password, $current_password) == $current_password){
			return $query;
		}
	}
}

/* End of file login_admin_model.php */
/* Location: ./applications/_control/models/login_admin_model.php */