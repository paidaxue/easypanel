<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('blog_m');
  }

  function _remap( $page_slug ) {
    if($this->uri->segment(2) != 'single') {
      $this->index( $this->uri->segment(2) );
    } else {
      $this->single();
    }
  }

  function index($page_slug) {
    $page_info = $this->main_model->get_page_by_page_slug($page_slug);
    $sidebars = $this->main_model->set_sidebars($page_info);
    $posts = $this->blog_m->get_posts();

    $data = array(
      'page_title'    => $page_info->title,
      'page_content'  => $page_info->content,
      'page_data'     => array(
        'POSTS' => $posts,
       ),
    );

    $template = $this->themes->build_template($data, $sidebars, false, $page_info->module);
    $base = $this->themes->get_base();
    $this->parser->parse($base, $template);
  }

  function single() {
    $id_post = $this->uri->segment(3);
    $post_info = $this->blog_m->get_post_by_id($id_post);

    $data = array(
      'page_title'    => $post_info->title,
      'page_data'     => array(
        'title' => $post_info->title,
        'image' => $post_info->image,
        'date_created' => $post_info->date_created,
        'content' => $post_info->content,
       ),
    );

    $template = $this->themes->build_template($data, array(), false, 'blog', 'blog_simple');
    $base = $this->themes->get_base();
    $this->parser->parse($base, $template);
  }
}