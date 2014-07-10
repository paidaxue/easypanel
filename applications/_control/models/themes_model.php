<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Themes_model extends CI_Model {

	function enable_theme($id_theme){
		// Disabling all
		$update_data['active'] = 0;
		$update_data['name'] = 'theme';

		$this->db->where('active', 1);
		$this->db->update('ep_themes', $update_data);

		// Enabling $id
		$new_update_data['active'] = 1;
		$this->db->where('id_theme', $id_theme);
		$this->db->update('ep_themes', $new_update_data);
	}

}