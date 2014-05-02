<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sidebars_admin_model extends CI_Model {

	/**
	 * Get all sidebars
	 */
	function get_all_sidebars() {

		return $this->db->get('ep_sidebars')->result();

	}

	/**
	 * Get by id
	 */
	function get_by_id($id_sidebar) {

		return $this->db->get_where('ep_sidebars', array('id_sidebar' => $id_sidebar))->row();

	}

	/**
	 * Delete by id
	 */
	function delete_sidebar($id_sidebar) {

		return $this->db->delete('ep_sidebars', array('id_sidebar' => $id_sidebar));

	}

	/**
	 * Update by id
	 */
	function update_sidebar($sidebar, $id_sidebar) {

		return $this->db->update('ep_sidebars', $sidebar , array('id_sidebar' => $id_sidebar));

	}


}

/* End of file sidebards_admin_model.php */
/* Location: ./applications/_control/models/sidebards_admin_model.php */