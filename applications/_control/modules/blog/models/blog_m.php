<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_m extends CI_Model {

  /**
   * Get all posts
   * @return object all blog posts
   */
  function get_posts() {
    return $this->db->get('blog')->result();
  }

  /**
   * Gets post by id
   * @param int $id_post id of the post
   * @return object post from db
   */
  function get_post_by_id($id_post) {
    return $this->db->get_where('blog', array('id_post' => $id_post))->row();
  }

  /**
   * Inserts a post
   * @param array $post post content data for insert
   * @return executes query
   */
  function insert_post($post) {
    return $this->db->insert('blog', $post);
  }

  /**
   * Updates a post
   * @param array $post post content data for update
   * @param int $id_post id of the post to be updated
   * @return executes query
   */
  function update_post($post, $id_post) {
    return $this->db->update('blog', $post, array('id_post' => $id_post));
  }

  /**
   * Deletes a post
   * @param int $id_post id of the post to be deleted
   * @return executes query
   */
  function delete_post($id_post) {
    return $this->db->delete('blog', array('id_post' => $id_post));
  }
}