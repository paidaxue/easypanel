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

  function register_user_return($data){
    $this->db->insert('ep_admin_users', $data);

    $this->db->limit(1);
    $this->db->order_by('id_user', 'DESC');
    return $query = $this->db->get('ep_admin_users')->row();
  }

  function register_user($data){
    $this->db->insert('ep_admin_users', $data);
  }

  function update_user($user_data){
    $data['fullname'] = $user_data['fullname'];
    $data['user']     = $user_data['user'];
    $data['pass']     = $user_data['pass'];
    $data['email']    = $user_data['email'];
    $data['avatar']   = $user_data['avatar'];
    $this->db->where('id_user', $user_data['id_user']);
    $this->db->update('ep_admin_users', $data);
  }
}