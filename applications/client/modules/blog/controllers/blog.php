<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('blog_m');
  }

  function _remap( $page_slug ) {
    $this->index( $page_slug );
  }

  function index($page_slug) {
    $page_info = $this->main_model->get_page_by_page_slug($page_slug);
    $posts = $this->blog_m->get_posts();

    $data = array(
      'page_title'    => $page_info->title,
      'page_content'  => $page_info->content,
      'page_data'     => array(
                          'POSTS' => $posts,
                         ),
    );

    $template = $this->themes->build_template(
      $data,
      $page_info->sidebar_style,
      $page_info->sidebar_right != 0 ? $page_info->sidebar_right : '0',
      $page_info->sidebar_left != 0 ? $page_info->sidebar_left : '0',
      $page_info->module
    );
    $base = $this->themes->get_base();
    $this->parser->parse($base, $template);
  }

  function test() {
    $this->themes->get_theme_files('blog', 'blog_single');
  }
}