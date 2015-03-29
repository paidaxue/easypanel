<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_m extends CI_Model {

	/**
	 * Verifies access for admin panel
	 * @param  string $username
	 * @param  string $password
	 * @return object
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