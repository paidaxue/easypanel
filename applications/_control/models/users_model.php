<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
  /**
   * [get_users description]
   * @return [type] [description]
   */
  function get_users($id_user){
    return $this->db->get_where('ep_admin_users', array('id_user !=' => $id_user))->result_array();
  }

  function get_user_data($id_user){
  	return $this->db->get_where('ep_admin_users', array('id_user' => $id_user))->row();
  }

  function delete_user($id_user){
    $this->db->delete('ep_admin_users', array('id_user' => $id_user));
  }

}