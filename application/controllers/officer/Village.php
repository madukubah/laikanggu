<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Village extends Officer_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/village/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Village_services');
		$this->services = new Village_services;
		$this->load->model(array(
			'village_model',
		));
		$this->data[ "menu_list_id" ] = "village_index";
	}	
	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url( $this->current_page ) .'/index';
		$pagination['total_records'] = $this->village_model->record_count() ;
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page*$pagination['limit_per_page'];
		$pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records']>0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->village_model->villages( $pagination['start_record']  , $pagination['limit_per_page'] )->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "contents" ] = $table;
		
		$link_add = 
		array(
			"name" => "Tambah",
			"type" => "link",
			"url" => site_url( $this->current_page."add/"),
			"button_color" => "primary",	
			"data" => NULL,
		);
		$this->data[ "header_button" ] =  $this->load->view('templates/actions/link', $link_add, TRUE ); 
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Desa";
		$this->data["header"] = "Desa";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render( "templates/contents/plain_content" );
	}

	public function add(  )
	{
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ( $this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );
			$data['polygon'] = $this->input->post( 'polygon' );

			// add user first
			$group = $this->ion_auth->group_by_name( "village_officer" )->row();
			if( $group == NULL ) redirect( site_url($this->current_page)  );

			$group_id = $group->id;

			$email = $data['name'] ;
			$email = str_replace( " ", "_", $email );
			$email = $email."@gmail.com";

			$identity = $email;
			$password = substr( $email, 0, strpos( $identity, "@" ) ) ;


			$additional_data = array(
				'first_name' => "admin",
				'last_name' => $data['name'],
				'email' => $email,
				'phone' => 00,
				'address' => "Alamat",
			);
			$identity_mode = NULL;
			if ( ( $user_id =  $this->ion_auth->register($identity, $password, $email, $additional_data, [$group_id], $identity_mode ) ) == FALSE )
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->ion_auth->errors() ) );
				redirect( site_url( $this->current_page  )  );
			}
			$data['user_id'] = $user_id;
			// add user first

			if( $this->village_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->village_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->village_model->errors() ) );
			}
			redirect( site_url($this->current_page)  );
		}
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->village_model->errors() ? $this->village_model->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->village_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

            $alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah Desa ";
			$this->data["header"] = "Tambah Desa ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

            $form_data = $this->services->get_form_data();
            $form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;

            $this->data[ "contents" ] =  $form_data;
            
            $this->render( "templates/contents/plain_content_form" );
        }
	}

	public function edit( $village_id = NULL )
	{
		if( $village_id == NULL ) redirect( site_url($this->current_page)  );

		$this->form_validation->set_rules( $this->services->validation_config() );
        if ( $this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );
			$data['polygon'] = $this->input->post( 'polygon' );

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->village_model->update( $data, $data_param ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->village_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->village_model->errors() ) );
			}
			redirect( site_url($this->current_page)  );
		}
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->ion_auth->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

            $alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah Desa ";
			$this->data["header"] = "Tambah Desa ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

            $form_data = $this->services->get_form_data( $village_id );
            $form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;

            $this->data[ "contents" ] =  $form_data;
            
            $this->render( "templates/contents/plain_content_form" );
        }
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );

		$data_param['id'] 	= $this->input->post('id');
		if( $this->village_model->delete( $data_param ) ){

			if(  ! $this->ion_auth->delete_user( $this->input->post('user_id') ) ) redirect( site_url($this->current_page )  );
			  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->village_model->messages() ) );
			  
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->village_model->errors() ) );
		}
		redirect( site_url($this->current_page )  );
	  }
}
