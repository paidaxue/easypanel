<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

	function __construct() {

    parent::__construct();

		//html files folder
		$this->folder_name = 'pages/';

		//files suffix
		$this->files_suffix = '_pages';

		/* ===== MODELS & HELPERS ===== */
		$this->load->model( 'pages_model' );
		$this->load->model( 'sidebars_admin_model' );
		$this->load->helper( 'pages' );

  }

	/**
	 * Pages main page
	 */
	function index() {

		//get filenames
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );

		//get content
		$pages = $this->pages_model->get_all_pages();

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

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * Add page
	 */
	function add() {
		//get filenames
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );

		$page_title = $this->lang->line('pages_page_title');

		$page_type = $this->pages_model->get_parents();
		$modules = $this->pages_model->get_modules();

		$sidebars = $this->sidebars_admin_model->get_all_sidebars();

		$content = $this->parser->parse( $filenames[ 'add_page' ], array(
						'PAGE_TYPE' 										=> $page_type,
						'MODULES' 											=> $modules,
						'SIDEBARS'											=> $sidebars,
						'lang_add_new_page' 						=> $this->lang->line('pages_add_new_page'),
						'lang_title_field' 							=> $this->lang->line('pages_title_field'),
						'lang_content_type_field' 			=> $this->lang->line('pages_content_type_field'),
						'lang_content_field' 						=> $this->lang->line('pages_content_field'),
						'lang_menu_options' 						=> $this->lang->line('pages_menu_options'),
						'lang_page_type_field' 					=> $this->lang->line('pages_page_type_field'),
						'lang_default_page_type_value' 	=> $this->lang->line('pages_default_page_type_value'),
						'lang_empty_page_type_value' 		=> $this->lang->line('pages_empty_page_type_value'),
						'lang_required_fields' 					=> $this->lang->line('error_required_fields'),
						'lang_submit_form' 							=> $this->lang->line('pages_submit_form'),
						'lang_sidebars_style' 							=> $this->lang->line('pages_sidebars_style'),
						'lang_sidebar_none' 							=> $this->lang->line('pages_sidebar_none'),
						'lang_sidebar_left' 							=> $this->lang->line('pages_sidebar_left'),
						'lang_sidebar_right' 							=> $this->lang->line('pages_sidebar_right'),
						'lang_sidebar_both' 							=> $this->lang->line('pages_sidebar_both'),
						'lang_sidebar_options' 							=> $this->lang->line('pages_sidebars_option'),
						'lang_sidebar_name' 							=> $this->lang->line('pages_sidebar_name'),
						'lang_sidebar_name_left' 						=> $this->lang->line('pages_sidebar_name_left'),
						'lang_sidebar_name_right' 						=> $this->lang->line('pages_sidebar_name_right')

																																), true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * add a page process
	 */
	function add_process() {

		$pages[ 'title' ] = $this->input->post( 'title', true );
		$pages[ 'page_type' ] = $this->input->post( 'page_type' );
		$pages[ 'module' ] = $this->input->post( 'modules' );

		$pages[ 'content' ] = $this->input->post( 'editor1' );
		$pages[ 'sidebar_style'] = $this->input->post('sidebar_style');

		if($pages['sidebar_style'] == 'none') {
			$pages['sidebar_left'] = '0';
			$pages['sidebar_right'] = '0';
		}

		if($pages['sidebar_style'] == 'left') {
			$pages['sidebar_left'] = $this->input->post('sidebar_left');
			$pages['sidebar_right'] = '0';
		}

		if($pages['sidebar_style'] == 'right') {
			$pages['sidebar_left'] = '0';
			$pages['sidebar_right'] = $this->input->post('sidebar_right');
		}

		if($pages['sidebar_style'] == 'both') {
			$pages['sidebar_left'] = $this->input->post('sidebar_left');
			$pages['sidebar_right'] = $this->input->post('sidebar_right');
		}

			$link_title = $pages[ 'title' ];
			$link_title_lowercase = strtolower($link_title);
			$link_title = str_replace(' ', '_', $link_title_lowercase);

		$pages[ 'link_title' ] = $link_title;

		$this->pages_model->insert_page( $pages );

		redirect( '_control.php/pages' );

	}

	/**
	 * Edit page
	 */
	function edit( $id_page ) {

		//get filenames
		$filenames = get_filenames( $this->folder_name, $this->files_suffix );

		$page_info = $this->pages_model->get_page_by_id( $id_page );

		$sidebars = $this->pages_model->get_sidebars();

		$page_type = $this->pages_model->get_parents_by_id( $id_page );
		foreach( $page_type as $type ) {

			if( $page_info->page_type == $type->id_page ) {

				$type->selected = "selected = 'selected'";

			} else {

				$type->selected = "";

			}

		}

		$modules = $this->pages_model->get_modules();
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
				'SIDEBARS'											=> $sidebars,
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
				'lang_empty_page_type_value' 		=> $this->lang->line('pages_empty_page_type_value'),
				'lang_required_fields' 					=> $this->lang->line('error_required_fields'),
				'lang_submit_form' 							=> $this->lang->line('pages_submit_form'),

				'lang_sidebars_style' 							=> $this->lang->line('pages_sidebars_style'),
						'lang_sidebar_none' 							=> $this->lang->line('pages_sidebar_none'),
						'lang_sidebar_left' 							=> $this->lang->line('pages_sidebar_left'),
						'lang_sidebar_right' 							=> $this->lang->line('pages_sidebar_right'),
						'lang_sidebar_both' 							=> $this->lang->line('pages_sidebar_both'),
						'lang_sidebar_options' 							=> $this->lang->line('pages_sidebars_option'),
						'lang_sidebar_name' 							=> $this->lang->line('pages_sidebar_name'),
						'lang_sidebar_name_left' 						=> $this->lang->line('pages_sidebar_name_left'),
						'lang_sidebar_name_right' 						=> $this->lang->line('pages_sidebar_name_right')
			), true );

		$page = page_builder( 'header', $page_title, 'body', 'body_header', 'top_nav', 'body_content', $content );
		$this->parser->parse( 'base_template', $page );

	}

	/**
	 * edit a page process
	 */
	function edit_process( $id_page ) {

		$pages[ 'title' ] = $this->input->post( 'title', true );
		$pages[ 'page_type' ] = $this->input->post( 'page_type' );
		$pages[ 'module' ] = $this->input->post( 'modules' );

		$pages[ 'content' ] = $this->input->post( 'editor1' );
		$pages[ 'sidebar_style'] = $this->input->post('sidebar_style');

		if($pages['sidebar_style'] == 'none') {
			$pages['sidebar_left'] = '0';
			$pages['sidebar_right'] = '0';
		}

		if($pages['sidebar_style'] == 'left') {
			$pages['sidebar_left'] = $this->input->post('sidebar_left');
			$pages['sidebar_right'] = '0';
		}

		if($pages['sidebar_style'] == 'right') {
			$pages['sidebar_left'] = '0';
			$pages['sidebar_right'] = $this->input->post('sidebar_right');
		}

		if($pages['sidebar_style'] == 'both') {
			$pages['sidebar_left'] = $this->input->post('sidebar_left');
			$pages['sidebar_right'] = $this->input->post('sidebar_right');
		}
			
			$link_title = $pages[ 'title' ];
			$link_title_lowercase = strtolower($link_title);
			$link_title = str_replace(' ', '_', $link_title_lowercase);

		$pages[ 'link_title' ] = $link_title;

		$this->pages_model->update_page( $pages, $id_page );

		redirect( '_control.php/pages' );

	}

	/**
	 * Delete a page
	 */
	function page_delete() {

		$id_page = $this->input->post('id_page');

		$this->pages_model->delete_page( $id_page );

		redirect( '_control.php/pages' );

	}

}

/* End of file pages.php */
/* Location: ./applications/_control/controllers/pages.php */