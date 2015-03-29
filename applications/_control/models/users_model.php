<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
  /**
   * Gets all registered users
   * @return array of arrays
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
   * Update user by ID
   * @param  array    $data
   * @param  integer  $id_user
   * @return object
   */
  function update_user_by_id( $data, $id_user ) {
    $this->db->update( 'ep_admin_users', $data, array( 'id_user' => $id_user ) );
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
   * Gets information about the logged user.
   * @param  integer $id_user
   * @return object
   */
  function logged_user( $id_user ) {
    return $this->db->get_where('ep_admin_users', array('id_user' => $id_user))->row();
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

  /**
   * Inserts the token code into database
   * @param  string token md5 combination between user id and email
   * @return
   */
  function insert_token($id_user, $token){
    $data['token'] = $token;
    $data['reset_active'] = 1;

    $this->db->where('id_user', $id_user);
    $this->db->update('ep_admin_users', $data);
  }

  function send_email($user_data){
    $template = 'Thank you for using our reset password service! Use the following link to change your password: '.base_url().'_control.php/users/reset_password/'.$user_data['id_user'].'/'.$user_data['token'];
    $this->email->from('easypanel@easypanel.com', 'Easy Panel');
    $this->email->to($user_data['email']);
    $this->email->subject('Easy Panel - Reset Password');
    $this->email->message($template);

    $this->email->send();
  }

  function check_reset_activity($id_user){
    $this->db->where('id_user', $id_user);
    $user_data = $this->db->get('ep_admin_users')->row_array();

    if($user_data['reset_active'] == 0){
      echo 'This account did not requested a password reset!';
      die();
    }
  }

  function check_token($id_user, $token){
    $this->db->where('id_user', $id_user);
    $user_data = $this->db->get('ep_admin_users')->row_array();

    if($user_data['token'] != $token){
      echo 'There was a problem with your token code! Please request a new one!';
      die();
    }
  }

  function reset_null($id_user){
    $data['reset_active'] = 0;
    $this->db->where('id_user', $id_user);
    $this->db->update('ep_admin_users', $data);
  }

  function change_pass($id_user, $password){
    $data['pass'] = crypt($password);
    $this->db->where('id_user', $id_user);
    $this->db->update('ep_admin_users', $data);
  }
}