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
}