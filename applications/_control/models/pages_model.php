<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model {

	/**
	 * Gets all pages
	 */
	function get_all_pages() {

		return $this->db->get('ep_pages')->result();

	}

	/**
	 * Get page by id
	 */
	function get_page_by_id( $id_page ) {

		return $this->db->get_where('ep_pages', array('id_page' => $id_page))->row();

	}

	/**
	 * Gets all parent pages
	 */
	function get_parents() {

		$this->db->where('page_type', 'parent');
		$this->db->or_where('page_type', 'parent-no-link');
		return $this->db->get('ep_pages')->result();

	}

	/**
	 * Get parents by id
	 */
	function get_parents_by_id( $id_page ) {

		$this->db->where('page_type', 'parent');
		$this->db->or_where('page_type', 'parent-no-link');
		$this->db->or_where('id_page !=', $id_page);
		return $this->db->get('ep_pages')->result();

		//return $this->db->get_where('ep_pages', array('page_type' => '1', 'page_type' => '0', 'id_page !=' => $id_page))->result();

	}

	/**
	 * Gets all modules
	 */
	function get_modules() {

			return $this->db->get('ep_modules')->result();
	}

	/**
	 * Inserts a new page
	 */
	function insert_page( $page ) {

		return $this->db->insert( "ep_pages", $page );

	}

	/**
	 * Update a page
	 */
	function update_page( $page, $id_page ) {

		return $this->db->update( "ep_pages", $page, array( 'id_page' => $id_page ) );

	}

	/**
	 * Delete a page
	 */
	function delete_page( $id_page ) {

		return $this->db->delete('ep_pages', array('id_page' => $id_page));

	}

	/**
	 * Get sidebars
	 */
	function get_sidebars() {

		return $this->db->get('ep_sidebars')->result();

	}

}

/* End of file pages_model.php */
/* Location: ./applications/_control/models/pages_model.php */