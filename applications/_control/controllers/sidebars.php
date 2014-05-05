<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sidebars extends MY_Controller {

	function __construct() {

    parent::__construct();

    //html files folder
		$this->folder_name = 'sidebars/';

		//files suffix
		$this->files_suffix = '_sidebars';

		/* ===== MODELS & HELPERS ===== */
		$this->load->model( 'sidebars_admin_model' );
		$this->load->helper( 'sidebars' );


  }

	/**
	 * sidebards page
	 */
	function index() {
		//get filenames
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );

		//get content
		$sidebars = $this->sidebars_admin_model->get_all_sidebars();

		//fallback message
		$no_content = $this->lang->line('error_no_pages');

		$page_title = $this->lang->line('sidebars_sidebar_title');

		if( empty( $sidebars ) ) {

			$content = $this->parser->parse( $filenames[ 'no-content' ], array(
																																			'no_content' 			=> $no_content,
																																			'lang_sidebar_title' => $page_title,
																																			'lang_add_sidebar'	 	=> $this->lang->line('sidebars_add_sidebar')
																																		), true );
		} else {

			$content = $this->parser->parse( $filenames[ 'list' ], array(
																																'SIDEBARS' 							=> $sidebars,
																																'lang_sidebar_title' 		=> $page_title,
																																'lang_title_column' 	=> $this->lang->line('sidebars_title_column'),
																																'lang_edit_column' 		=> $this->lang->line('sidebars_edit_column'),
																																'lang_delete_column' 	=> $this->lang->line('sidebars_delete_column'),
																																'lang_add_sidebar' 			=> $this->lang->line('sidebars_add_sidebar')
																															), true );
						}
		$sidebars = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $sidebars );

	}

	/**
	 * Edit page
	 */
	function edit( $id_sidebar ) {

		//get filenames
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );

		$sidebar_info = $this->sidebars_admin_model->get_by_id( $id_sidebar );

		$sidebar_name = $this->lang->line('pages_edit_page') . $sidebar_info ->name;

		$content = $this->parser->parse( $filenames[ 'edit_sidebar' ], array(
			'name' 												=> $sidebar_info->name,
			'id_sidebar' 											=> $sidebar_info->id_sidebar,
			'content' 											=> $sidebar_info->content,
			'lang_edit_page' 									=> $this->lang->line('pages_edit_page'),
			'lang_title_field' 									=> $this->lang->line('pages_title_field'),
			'lang_content_type_field' 							=> $this->lang->line('pages_content_type_field'),
			'lang_content_field' 								=> $this->lang->line('pages_content_field'),
			'lang_menu_options' 								=> $this->lang->line('pages_menu_options'),
			'lang_page_type_field' 								=> $this->lang->line('pages_page_type_field'),
			'lang_default_page_type_value' 						=> $this->lang->line('pages_default_page_type_value'),
			'lang_empty_page_type_value' 						=> $this->lang->line('pages_empty_page_type_value'),
			'lang_required_fields' 								=> $this->lang->line('error_required_fields'),
																				'lang_submit_form' 							=> $this->lang->line('pages_submit_form'),
			), true );

		$page = page_builder( 'header', $sidebar_name, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * edit a sidebar process
	 */
	function edit_process( $id_sidebar ) {

		$sidebar[ 'name' ] = $this->input->post( 'title', true );
		$sidebar[ 'content' ] = $this->input->post( 'content' );

		$this->sidebars_admin_model->update_sidebar( $sidebar, $id_sidebar );

		redirect( '_control.php/sidebars' );

	}

	/**
	 * Delete a page
	 */
	function sidebar_delete() {

		$id_sidebar = $this->input->post('id_sidebar');

		$this->sidebars_admin_model->delete_sidebar( $id_sidebar );

		redirect( '_control.php/sidebars' );

	}

	/**
	 * Add a sidebar
	 */
	function add() {

		//get filenames
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );

		$page_title = $this->lang->line('sidebars_sidebar_title');


		$content = $this->parser->parse( $filenames[ 'add_sidebar' ], array(
								'lang_add_new_page' 						=> $this->lang->line('sidebars_add_new_sidebar'),
								'lang_title_field' 							=> $this->lang->line('sidebars_title_field'),
								'lang_content_type_field' 			=> $this->lang->line('sidebars_content_type_field'),
								'lang_content_field' 						=> $this->lang->line('sidebars_content_field'),
								'lang_empty_page_type_value' 		=> $this->lang->line('sidebars_empty_page_type_value'),
								'lang_required_fields' 					=> $this->lang->line('error_required_fields'),
								'lang_submit_form' 							=> $this->lang->line('sidebars_submit_form')
							), true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );
	}

	/**
	 * Add a sidebar
	 */
	function add_procces() {

		$sidebar[ 'name' ] = $this->input->post( 'title', true );
		$sidebar[ 'content' ] = $this->input->post( 'content' );


		$this->sidebars_admin_model->insert_sidebar( $sidebar );

		redirect( '_control.php/sidebars' );

	}

}

/* End of file sidebars.php */
/* Location: ./applications/_control/controllers/sidebars.php */