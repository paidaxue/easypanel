<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	function __construct() {

    parent::__construct();

		/* ===== MODELS ===== */
		$this->load->model( 'pages_model' );

		//html files folder
		$this->folder_name = 'pages/';

		//files suffix
		$this->files_suffix = '_pages';

    }

	/**
	 * pages
	 */
	function index() {

		//get filenames
		$filenames = $this->pages_model->getFilenames( $this->folder_name, $this->files_suffix );

		//get content
		$pages = $this->db->query( "select * from ep_pages" )->result();

		//fallback message
		$no_content = $this->lang->line('error_no_pages');

		$page_title = $this->lang->line('pages_page_title');

		if( empty( $pages ) ) {

			$content = $this->parser->parse( $filenames[ 'no-content' ], array(
																																			'no_content' 			=> $no_content,
																																			'lang_page_title' => $page_title,
																																			'lang_add_page'	 	=> $this->lang->line('pages_add_page')
																																		), true );

		} else {

			$content = $this->parser->parse( $filenames[ 'list' ], array(
																																'PAGES' 							=> $pages,
																																'lang_page_title' 		=> $page_title,
																																'lang_title_column' 	=> $this->lang->line('pages_title_column'),
																																'lang_edit_column' 		=> $this->lang->line('pages_edit_column'),
																																'lang_delete_column' 	=> $this->lang->line('pages_delete_column'),
																																'lang_add_page' 			=> $this->lang->line('pages_add_page')
																															), true );

		}

		$page = $this->main_admin_model->getPage( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * add a page
	 */
	function add() {

		//get filenames
		$filenames = $this->pages_model->getFilenames( $this->folder_name, $this->files_suffix );

		//get content
		$page_type = $this->db->query("select * from ep_pages where page_type='1'")->result();
		$modules = $this->db->query("select * from ep_modules")->result();

		$page_title = $this->lang->line('pages_page_title');

		$content = $this->parser->parse( $filenames[ 'add_page' ], array(
																																	'PAGE_TYPE' 										=> $page_type,
																																	'MODULES' 											=> $modules,
																																	'lang_add_new_page' 						=> $this->lang->line('pages_add_new_page'),
																																	'lang_title_field' 							=> $this->lang->line('pages_title_field'),
																																	'lang_content_type_field' 			=> $this->lang->line('pages_content_type_field'),
																																	'lang_content_field' 						=> $this->lang->line('pages_content_field'),
																																	'lang_menu_options' 						=> $this->lang->line('pages_menu_options'),
																																	'lang_page_type_field' 					=> $this->lang->line('pages_page_type_field'),
																																	'lang_default_page_type_value' 	=> $this->lang->line('pages_default_page_type_value'),
																																	'lang_required_fields' 					=> $this->lang->line('error_required_fields'),
																																	'lang_submit_form' 							=> $this->lang->line('pages_submit_form')
																																), true );

		$page = $this->main_admin_model->getPage( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * add a page process
	 */
	function add_process() {

		$pages[ 'title' ] = $this->input->post( 'title' );
		$pages[ 'page_type' ] = $this->input->post( 'page_type' );
		$pages[ 'module' ] = $this->input->post( 'modules' );
		$pages[ 'content' ] = $this->input->post( 'content' );

		if( $pages[ 'module' ] == 'homepage' ) {

			$link_title = "homepage";

		} else {

			$link_title = $pages[ 'title' ];
			$link_title_lowercase = strtolower($link_title);
			$link_title = str_replace(' ', '_', $link_title_lowercase);

		}

		$pages[ 'link_title' ] = $link_title;

		$this->db->insert( "ep_pages", $pages );

		redirect( 'pages' );

	}

	/**
	 * edit a page
	 */
	function edit( $id_page ) {

		//get filenames
		$filenames = $this->pages_model->getFilenames( $this->folder_name, $this->files_suffix );

		$page_info = $this->db->query( "select * from ep_pages where id_page = '".$id_page."' " )->row();

		$page_type = $this->db->query( "select * from ep_pages where page_type = '1' and id_page <> '".$id_page."'")->result();
		foreach( $page_type as $type ) {

			if( $page_info->page_type == $type->id_page ) {

				$type->selected = "selected = 'selected'";

			} else {

				$type->selected = "";

			}

		}

		$modules = $this->db->query( "select * from ep_modules" )->result();
		foreach( $modules as $mod ){

			if ( $mod->nickname == $page_info->module ) {

				$mod->selected = "selected='selected'";

			} else {

				$mod->selected = "";

			}

		}

		$page_title = $this->lang->line('pages_edit_page') . $page_info->title;

		$content = $this->parser->parse( $filenames[ 'edit_page' ], array(
																																	'PAGE_TYPE' 										=> $page_type,
																																	'MODULES' 											=> $modules,
																																	'title' 												=> $page_info->title,
																																	'id_page' 											=> $page_info->id_page,
																																	'content' 											=> $page_info->content,
																																	'lang_edit_page' 								=> $this->lang->line('pages_edit_page'),
																																	'lang_title_field' 							=> $this->lang->line('pages_title_field'),
																																	'lang_content_type_field' 			=> $this->lang->line('pages_content_type_field'),
																																	'lang_content_field' 						=> $this->lang->line('pages_content_field'),
																																	'lang_menu_options' 						=> $this->lang->line('pages_menu_options'),
																																	'lang_page_type_field' 					=> $this->lang->line('pages_page_type_field'),
																																	'lang_default_page_type_value' 	=> $this->lang->line('pages_default_page_type_value'),
																																	'lang_required_fields' 					=> $this->lang->line('error_required_fields'),
																																	'lang_submit_form' 							=> $this->lang->line('pages_submit_form'),
																																), true );

		$page = $this->main_admin_model->getPage( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * edit a page process
	 */
	function edit_process( $id_page ) {

		$pages[ 'title' ] = $this->input->post( 'title' );
		$pages[ 'page_type' ] = $this->input->post( 'page_type' );
		$pages[ 'module' ] = $this->input->post( 'modules' );
		$pages[ 'content' ] = $this->input->post( 'content' );

		if( $pages[ 'module' ] == 'homepage' ) {

			$link_title = "homepage";

		} else {

			$link_title = $pages[ 'title' ];
			$link_title_lowercase = strtolower($link_title);
			$link_title = str_replace(' ', '_', $link_title_lowercase);

		}

		$pages[ 'link_title' ] = $link_title;

		$this->db->update( "ep_pages", $pages, array( 'id_page' => $id_page ) );

		redirect( 'pages' );

	}

	/**
	 * delete a page
	 */
	function page_delete() {

		$id_page = $this->input->post('id_page');

		$this->db->query("delete from ep_pages where id_page = '".$id_page."' ");
		redirect("pages");

	}

}
