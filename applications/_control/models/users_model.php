<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
  /**
   * [get_users description]
   * @return [type] [description]
   */
  function get_users($id_user){
    return $this->db->get_where('ep_admin_users', array('id_user !=' => $id_user))->result_array();
  }
  /**
   * Gets all user data
   * @param  $id_user
   * @return object containing user data
   */
  function get_user_data($id_user){
  	return $this->db->get_where('ep_admin_users', array('id_user' => $id_user))->row();
  }

  /**
   * Deletes an user ($id_user)
   * @param  int $id_user the id of the user which is gonna be deleted
   * @return
   */
  function delete_user($id_user){
    $this->db->delete('ep_admin_users', array('id_user' => $id_user));
  }

  /**
   * Registers an user and after returns it's
   * new id, used for updating his avatar
   * @param  $data all userdata
   * @return returns an object
   */
  function register_user_return($data){
    $this->db->insert('ep_admin_users', $data);

    $this->db->limit(1);
    $this->db->order_by('id_user', 'DESC');
    return $query = $this->db->get('ep_admin_users')->row();
  }

  /**
   * Registers an user
   * @param  array $data data about the user
   * @return
   */
  function register_user($data){
    $this->db->insert('ep_admin_users', $data);
  }

  /**
   * Updates an user, except his ID
   * @param  array $user_data all data about the user
   * @return
   */
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