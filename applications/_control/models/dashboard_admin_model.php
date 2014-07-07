<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_admin_model extends CI_Model {


	/**
	 * Dashboard stats - for pages
	 */
	function get_page_records () {

		return $this->db->get('ep_pages')->result();

	}

	/**
	 * Dashboard stats - modules
	 */
	function get_module_records () {

		return $this->db->get_where('ep_modules', array('module_slug !=' => 'simple_page'))->result();

	}

	/**
	 * Dashboard stats - posts
	 */
	function get_posts_records () {

		return $this->db->get('blog')->result();

	}
}

/* End of file dashboard_admin_model.php */
/* Location: ./applications/_control/models/dashboard_admin_model.php */