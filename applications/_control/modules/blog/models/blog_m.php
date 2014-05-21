<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_m extends CI_Model {

  /**
   * Get all posts
   * @return object all blog posts
   */
  function get_posts() {
    return $this->db->get('blog')->result();
  }
}