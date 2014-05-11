<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_admin_model extends CI_Model {

	/**
	 * Get setting by name
	 */
	function get_setting_by_name( $name ) {

		return $this->db->query("select * from ep_admin_settings where name = '" . $name . "'")->row()->value;

	}

	/**
	 * Update user
	 */
	function update_user_by_id( $data, $id_user ) {

		return $this->db->update( 'ep_admin_users', $data, array( 'id_user' => $id_user ) );

	}

	/**
	 * Update setting
	 */
	function update_setting( $data, $name ) {

		return $this->db->update( 'ep_admin_settings', $data, array( 'name' => $name ) );

	}

	/**
	 * Theme setting
	 */
	function get_themes() {

		return $this->db->get( 'ep_themes')->result();

	}

	/**
	 * Get themes by id
	 */
	function get_theme_by_id($id_theme){

		return $this->db->get_where('ep_themes', array('id_theme' => $id_theme))->row();
	
	}

	/**
	 * Update theme settings
	 */
	function update_theme_settings( $theme, $id_theme ) {

		return $this->db->update( 'ep_themes', $theme, array( 'id_theme' => $id_theme ) );

	}

	/**
	 * Insert new theme from folder
	 */
	function insert_theme( $theme_to_DB) {

		return $this->db->insert( 'ep_themes', $theme_to_DB );

	}

	/**
	 * Insert new theme from folder
	 */
	function delete_theme( $theme_delete) {

		return $this->db->delete( 'ep_themes', $theme_delete );

	}

}

/* End of file settings_admin_model.php */
/* Location: ./applications/_control/models/settings_admin_model.php */