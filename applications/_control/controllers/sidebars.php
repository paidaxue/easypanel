<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebars extends MY_Controller {
	function __construct() {
    parent::__construct();

    //html files folder
		$this->folder_name = 'sidebars/';

		//files suffix
		$this->files_suffix = '_sidebars';

		/* Load models, helpers and language */
		$this->load->model( 'sidebars_admin_model' );
		$this->load->helper( 'sidebars' );
		$this->langs = (array)$this->lang->line('sidebars');
  }

	/**
	 * List all sidebars
	 * @return void
	 */
	function index() {
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );
		$sidebars = $this->sidebars_admin_model->get_all_sidebars();
		$no_content = $this->lang->line('error_no_pages');

		$page_title = $this->langs['lang_page_title'];

		if( empty( $sidebars ) ) {
			$content = $this->parser->parse( $filenames[ 'no-content' ], array_merge(
				array('no_content' => $no_content),
				$this->langs
			), true );
		} else {
			$content = $this->parser->parse( $filenames[ 'list' ], array_merge(
				array('SIDEBARS' => $sidebars),
				$this->langs
			), true );
		}

		$sidebars = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $sidebars );
	}

	/**
	 * Add a new sidebar
	 * @return void
	 */
	function add() {
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );
		$page_title = $this->langs['lang_page_title'];

		$content = $this->parser->parse( $filenames[ 'add_sidebar' ], $this->langs, true );

		$page = page_builder( $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Form process for adding a sidebar.
	 * Returns to the index method
	 * @return void
	 */
	function add_procces() {
		$sidebar[ 'name' ] = $this->input->post( 'title', true );
		$sidebar[ 'content' ] = $this->input->post( 'content' );
		$this->sidebars_admin_model->insert_sidebar( $sidebar );
		redirect( '_control.php/sidebars' );
	}

	/**
	 * Edit sidebars
	 * @param  int   $id_sidebar sidebar id to be edited
	 * @return void
	 */
	function edit($id_sidebar) {
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );
		$sidebar_info = $this->sidebars_admin_model->get_by_id( $id_sidebar );
		$sidebar_name = $this->langs['lang_edit_sidebar'] . $sidebar_info ->name;

		$content_data = array(
			'name'				=> $sidebar_info->name,
			'id_sidebar'	=> $sidebar_info->id_sidebar,
			'content'			=> $sidebar_info->content,
		);

		$content = $this->parser->parse( $filenames[ 'edit_sidebar' ], array_merge($content_data, $this->langs), true );

		$page = page_builder( $sidebar_name, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Form process for editing a sidebar.
	 * Returns to index method
	 * @param  int   $id_sidebar sidebar id to be edited
	 * @return void
	 */
	function edit_process( $id_sidebar ) {
		$sidebar[ 'name' ] = $this->input->post( 'title', true );
		$sidebar[ 'content' ] = $this->input->post( 'content' );
		$this->sidebars_admin_model->update_sidebar( $sidebar, $id_sidebar );
		redirect( '_control.php/sidebars' );
	}

	/**
	 * Deletes a sidebar.
	 * Returns to the index method
	 * @return void
	 */
	function sidebar_delete() {
		$id_sidebar = $this->input->post('id_sidebar');
		$this->sidebars_admin_model->delete_sidebar( $id_sidebar );
		redirect( '_control.php/sidebars' );
	}
}