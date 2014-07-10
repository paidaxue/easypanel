<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Themes_model extends CI_Model {

	/**
	 * Returns an array with the theme's data
	 * @param  int $id_theme
	 * @return
	 */
	function get_theme_by_id($id_theme){
		return $this->db->get_where('ep_themes', array('id_theme' => $id_theme))->row_array();
	}

	/**
	 * Deletes the selected theme
	 * @param  int $id_theme the id of the theme
	 * @return
	 */
	function delete_theme($id_theme){
		$this->db->where('id_theme', $id_theme);
		$this->db->delete('ep_themes');

	}
}