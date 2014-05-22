<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('blog_m');
    $this->lang->load('english');
  }

  function index() {
    $posts = $this->blog_m->get_posts();
    $lang = $this->lang->line('blog_listings');
    $page_title = $lang['lang_page_title'];

    $data = array(
      'POSTS' => $posts,
    );

    $data = array_merge($data, $lang);

    $content = $this->parser->parse('listing', $data, true);

    $page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
    $this->parser->parse( 'base_template', $page );
  }

  function add() {
    $lang = $this->lang->line('blog_add');
    $page_title = $lang['lang_page_title'];

    $content = $this->parser->parse('add', $lang, true);

    $page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
    $this->parser->parse( 'base_template', $page );
  }

  function add_process() {
    $post['title'] = $this->input->post('title');
    $post['date_created'] = date("Y/m/d");
    $post['content'] = $this->input->post('content');

    if($_FILES['image']['name'] != '') {
      $path = './uploads/blog/';

      if(!is_dir($path)) {
        mkdir($path);
      }

      $image_name = basename($_FILES['image']['name']);
      $path = $path . $image_name;

      move_uploaded_file($_FILES['image']['tmp_name'], $path);

      $post['image'] = $image_name;
    }

    $this->blog_m->insert_post($post);
    redirect('_control.php/blog');
  }

  function edit($id_post) {
    $lang = $this->lang->line('blog_edit');
    $page_title = $lang['lang_page_title'];

    $post = $this->blog_m->get_post_by_id($id_post);
    $data = array(
      'id_post' => $post->id_post,
      'title'   => $post->title,
      'image'   => $post->image,
      'content' => $post->content,
    );

    $data = array_merge($data, $lang); // add lang to be parsed

    $content = $this->parser->parse('edit', $data, true);

    $page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
    $this->parser->parse( 'base_template', $page );
  }

  function edit_process($id_post) {
    $post_info = $this->blog_m->get_post_by_id($id_post);

    $post['title'] = $this->input->post('title');
    $post['date_created'] = date("Y/m/d");
    $post['content'] = $this->input->post('content');

    if($_FILES['image']['name'] != '') {
      $path = './uploads/blog/';

      if(file_exists($path . $post_info->image)) {
        unlink($path . $post_info->image);
      }

      if(!is_dir($path)) {
        mkdir($path);
      }

      $image_name = basename($_FILES['image']['name']);
      $path = $path . $image_name;

      move_uploaded_file($_FILES['image']['tmp_name'], $path);

      $post['image'] = $image_name;
    }

    $this->blog_m->update_post($post, $id_post);
    redirect('_control.php/blog');
  }

  function delete() {
    $id_post = $this->input->post('id_post');
    $all_posts = $this->blog_m->get_posts();
    $single_post = $this->blog_m->get_post_by_id($id_post);

    if(count($all_posts) == 1) {
      delete_directory('./uploads/blog');
    } else {
      unlink('./uploads/blog' . $single_post->image);
    }

    $this->blog_m->delete_post($id_post);
    redirect('_control.php/blog');
  }
}