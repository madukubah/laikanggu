
	public function add(  )
	{
			$no_kk = $this->input->get( "no_kk", NULL );
			if( $no_kk == NULL ) redirect( site_url($this->current_page)  );

			$civilization = $this->civilization_model->civilization_by_no_kk( $no_kk )->row();
			if( $civilization == NULL ) redirect( site_url($this->current_page)  );
			// echo var_dump( $civilization );return;

			$this->form_validation->set_rules( $this->services->validation_config() );
			if ( $this->form_validation->run() === TRUE )
			{
				$data['civilization_id'] 		= $this->input->post( 'civilization_id' );
				$data['category'] 					= $this->input->post( 'category' );
				$data['certificate_status'] = $this->input->post( 'certificate_status' );
				$data['rt'] 								= $this->input->post( 'rt' );
				$data['dusun'] 							= $this->input->post( 'dusun' );

				$data['latitude'] 					= $this->input->post( 'latitude' );
				$data['longitude'] 					= $this->input->post( 'longitude' );
				
				$this->load->library('upload'); // Load librari upload
				$config = $this->services->get_photo_upload_config( $data['no_kk'] = "" );

				$images_arr = array();
				foreach( ["file_scan", "front", "back", "left", "right" ] as $ind => $value )
				{
					$config[ "file_name" ] = $value."_".time();
					// echo $config[ "file_name" ]."<br>";
					$this->upload->initialize( $config ) ;
					if( $this->upload->do_upload( $value ) )
					{
						if( $ind == 0 ) $data['file_scan'] = $this->upload->data()["file_name"];
						else $images_arr []= $this->upload->data()["file_name"];

					}
					else
					{
						if( $ind == 0 ) $data['file_scan'] = "default.jpg" ;
						else $images_arr []= "default.jpg" ;
					}

				}
				$data['images'] = implode( ";", $images_arr );

				echo json_encode( $data );return;

				if( $this->housing_model->create( $data ) ){
					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->housing_model->messages() ) );
				}else{
					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->housing_model->errors() ) );
				}
				redirect( site_url($this->current_page)  );
			}
			else
			{
					$this->data['message'] = (validation_errors() ? validation_errors() : ($this->housing_model->errors() ? $this->housing_model->errors() : $this->session->flashdata('message')));
					if(  !empty( validation_errors() ) || $this->housing_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

					$form = $this->services->get_form_data( NULL, $civilization->id );

					$form_data = $form[0];
					$form_data = $this->load->view('templates/form/plain_form_6', $form_data , TRUE ) ;

					$form_data_1 = $form[1];
					$form_data_1 = $this->load->view('templates/form/plain_form', $form_data_1 , TRUE ) ;

					$form_data_2 = $form[2];
					$form_data_2 = $this->load->view('templates/form/plain_form_6', $form_data_2 , TRUE ) ;

					$form_data_3 = $form[3];
					$form_data_3 = $this->load->view('templates/form/plain_form_6', $form_data_3 , TRUE ) ;

					$this->data[ "contents" ] =  $form_data.$form_data_1.$form_data_2."<br>".$form_data_3;


					$alert = $this->session->flashdata('alert');
					$this->data["key"] = $this->input->get('key', FALSE);
					$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
					$this->data["current_page"] = $this->current_page;
					$this->data["block_header"] = "Tambah Rumah ";
					$this->data["header"] = "Tambah Rumah Untuk No KK ".$civilization->no_kk;
					$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

					$this->data["url_form"] = $this->current_page."add/?no_kk=".$no_kk;

					$this->render( "uadmin/housing/plain_content_form" );
			}
	}

	public function edit( )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['no_kk'] = $this->input->post( 'no_kk' );
			$data['chief_name'] = $this->input->post( 'chief_name' );
			$data['member_count'] = $this->input->post( 'member_count' );

			$this->load->library('upload'); // Load librari upload
			$config = $this->services->get_photo_upload_config( $data['no_kk'] );

			$this->upload->initialize( $config );
			// echo var_dump( $_FILES ); return;
			if( $_FILES['file_scan']['name'] != "" ) //if image not null
			if( $this->upload->do_upload("file_scan") )
			{
				$data['file_scan'] = $this->upload->data()["file_name"];
				if( !@unlink( $config['upload_path'].$this->input->post( '_file_scan' ) ) );
			}
			else
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->upload->display_errors() ) );
				redirect( site_url($this->current_page) ."village/". $this->input->post( 'village_id' )   );				
			}

			$data_param['id'] = $this->input->post( 'id' );
			if( $this->housing_model->update( $data, $data_param ) )
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->housing_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->housing_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->housing_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->housing_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)."village/". $this->input->post( 'village_id' )  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page)."village/". $this->input->post( 'village_id' )  );

		$this->load->library('upload'); // Load librari upload
		$config = $this->services->get_photo_upload_config( $data['no_kk'] );

		$data_param['id'] 	= $this->input->post('id');
		if( $this->housing_model->delete( $data_param ) ){
			if( !@unlink( $config['upload_path'].$this->input->post( '_file_scan' ) ) )return;

			$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->housing_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->housing_model->errors() ) );
		}
		redirect( site_url($this->current_page ) ."village/". $this->input->post( 'village_id' )  );
	  }
}
