<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Civilization extends Officer_Controller
{
	private $services = null;
	private $name = null;
	private $parent_page = 'officer';
	private $current_page = 'officer/civilization/';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/Civilization_services');
		$this->services = new Civilization_services;
		$this->load->model(array(
			'civilization_model',
			'village_model',
			'housing_model',
			'aid_model',
		));
		$this->data["menu_list_id"] = "civilization_index";
	}

	public function index( )
	{
		$search = $this->input->get( 'search', TRUE );

		$village = $this->data["village"];
		$village_id = $village->id;
		if ( $village_id == NULL) redirect(site_url($this->current_page));

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $this->civilization_model->record_count_by_village_id($village_id);
		$pagination['limit_per_page'] = 100;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 + 1;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config($this->current_page);

		if( isset( $search ) && $search != "" )
			$table[ "rows" ] = $this->civilization_model->search( $search , $village_id )->result(  );
		else
			$table["rows"] = $this->civilization_model->civilizations( $pagination['start_record'], $pagination['limit_per_page'], $village_id)->result();

		$table["image_url"] = $this->services->get_photo_upload_config("")["image_path"];
		// var_dump($table["rows"]); return;
		$table = $this->load->view('uadmin/civilization/plain_table_image_col', $table, true);

		
		
		$form_filter["form_data"] = array(
				"search" => array(
					'type' => 'text',
					'label' => "No KK",
					'value' => $search
				),
		);
		$form_filter["form"] = $this->load->view('templates/form/plain_form_horizontal', $form_filter, TRUE);
		$form_filter = $this->load->view('officer/filter_horizontal', $form_filter, TRUE);

		$this->data["contents"] = $form_filter. $table;

		$link_add = array(
			"name" => "Tambah Data",
			"button_color" => "primary",
			"url" => site_url($this->current_page . "add"),
			"data" => null,
			"get" => "?village_id=" . $village_id
		);

		$link_add = $this->load->view('templates/actions/link', $link_add, true);

		$search_ = array(
			"name" => "Cari",
			"modal_id" => "search_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page),
			"form_data" => array(
				"search" => array(
					'type' => 'text',
					'label' => "nama / no induk",
					'value' => $search
				),
			),
			'data' => NULL
		);

		$search_ = $this->load->view('templates/actions/modal_form_get', $search_, true );
		$modal_add = array(
			"name" => "Tambah Data",
			"modal_id" => "add_civilization_",
			"button_color" => "primary",
			"url" => site_url($this->current_page . "add/"),
			"form_data" => array(
				"no_kk" => array(
					'type' => 'text',
					'label' => "Masukkan No KK",
				),
			),
			'data' => NULL
		);

		$modal_add = $this->load->view('templates/actions/modal_form_get', $modal_add, true);

		$this->data["header_button"] =  $modal_add;		// return;
		#################################################################3
		// $village 				= $this->village_model->village($village_id)->row();

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Kartu Keluarga";
		$this->data["header"] = "Daftar KK " . $village->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function add( )
	{
		$village = $this->data["village"];
		$village_id = $village->id;
		
		$this->form_validation->set_rules($this->services->validation_config());
		if ($this->form_validation->run() === TRUE) {
			$data['no_kk'] 			= $this->input->post('no_kk');
			$data['chief_name'] 	= $this->input->post('chief_name');
			$data['member_count'] 	= $this->input->post('member_count');
			$data['income'] 		= $this->input->post('income');

			$data['age'] 			= $this->input->post('age');
			$data['study'] 			= $this->input->post('study');
			$data['job'] 			= $this->input->post('job');

			$data['village_id'] = $this->input->post('village_id');

			// echo var_dump( $data ); return;	

			$this->load->library('upload'); // Load librari upload
			$config = $this->services->get_photo_upload_config($data['no_kk']);

			$this->upload->initialize($config);
			// echo var_dump( $_FILES ); return;	
			if ($_FILES['file_scan']['name'] != "")
				if ($this->upload->do_upload("file_scan")) {
					$data['file_scan'] = $this->upload->data()["file_name"];
				} else {
					$data['file_scan'] = "default.jpg";
				}
			else $data['file_scan'] = "default.jpg";
			// KTP
			$config = $this->services->get_photo_upload_config( "KTP_".$data['no_kk']);

			$this->upload->initialize($config);
			if ($_FILES['civilization_card_scan']['name'] != "")
				if ($this->upload->do_upload("civilization_card_scan")) {
					$data['civilization_card_scan'] = $this->upload->data()["file_name"];
				} else {
					$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
					redirect(site_url($this->current_page) );
				}
			else $data['civilization_card_scan'] = "default.jpg";

			if ( ( $civilization_id =  $this->civilization_model->create($data) ) != FALSE ) 
			{
				$data_house['civilization_id'] 		= $civilization_id;
				$data_house['category'] 			= $this->input->post('category');
				$data_house['certificate_status'] 	= $this->input->post('certificate_status');
				$data_house['rt'] 					= $this->input->post('rt');
				$data_house['dusun'] 				= $this->input->post('dusun');

				$data_house['land_status'] 			= $this->input->post('land_status');
				$data_house['water_source'] 		= $this->input->post('water_source');
				$data_house['floor_material'] 		= $this->input->post('floor_material');
				$data_house['wall_material'] 		= $this->input->post('wall_material');
				$data_house['roof_material'] 		= $this->input->post('roof_material');

				$data_house['latitude'] 			= $this->input->post('latitude');
				$data_house['longitude'] 			= $this->input->post('longitude');

				$data_house['length'] 				= $this->input->post('length');
				$data_house['width'] 				= $this->input->post('width');

				$data_house['description'] 			= $this->input->post('description');

				#image
				$images_arr = array();
				foreach (["file_scan", "front", "back", "left", "right"] as $ind => $value) {
						if ($ind == 0) $data_house['file_scan'] = "default.jpg";
						else $images_arr[] = "default.jpg";
				}
				$data_house['images'] = implode(";", $images_arr);

				if (  $this->input->post('has_house') == 1 ) 
				{
					if ($this->housing_model->create($data_house)) 
					{
						$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->housing_model->messages()));
					} else {
						$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->housing_model->errors()));
					}
				}
					
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->civilization_model->messages()));
				
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->civilization_model->errors()));
			}
			redirect(site_url($this->current_page) );
		} else {
			#validasi no KK
			$no_kk = $this->input->get("no_kk");
			if ( ( !is_numeric( $no_kk ) ) || ( $no_kk == NULL )  ) 
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, "inputan tidak valid"));
				redirect(site_url($this->current_page));
			}

			$civilization = $this->civilization_model->civilization_by_no_kk_and_village_id($no_kk, $village_id)->row();
			if ($civilization != NULL) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, "Data Sudah Ada !"));
				redirect(site_url($this->current_page));
			}

			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->civilization_model->errors() ? $this->civilization_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->civilization_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

			$form_data_civilization = $this->services->get_form_data($village_id);
			$form_data_civilization["form_data"][ 'no_kk' ]['value'] = $no_kk;
			$form_data_civilization["form_data"][ 'no_kk' ]['readonly'] = '';
			$form_data_civilization = $this->load->view('templates/form/plain_form', $form_data_civilization, TRUE);

			$this->data["contents"] =  $form_data_civilization;

			#house
			$this->load->library('services/housing_services');
			$this->services = new housing_services;
			$form = $this->services->get_form_data();

			$form_data = $form[0];
			$form_data = $this->load->view('templates/form/plain_form_6', $form_data, TRUE);

			$form_data_1 = $form[1];
			$form_data_1 = $this->load->view('templates/form/plain_form', $form_data_1, TRUE);

			$form_data_2 = $form[2];
			$form_data_2 = $this->load->view('templates/form/plain_form_6', $form_data_2, TRUE);

			$form_data_3 = $form[3]; #LAT LONG
			$form_data_3 = $this->load->view('templates/form/plain_form_6', $form_data_3, TRUE);

			$form_data_4 = $form[4];
			$form_data_4 = $this->load->view('templates/form/plain_form', $form_data_4, TRUE);

			$this->data["house_contents"] =  $form_data . $form_data_3 . $form_data_4 ;

			$alert = $this->session->flashdata('alert');
			$this->data["no_kk"] = $this->input->get('no_kk', FALSE);
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah Data ";
			$this->data["header"] = "Tambah Data ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			// $this->data["url_form"] = $this->current_page . "add?village_id=" . $village_id;
			$this->render("uadmin/civilization/content_form_multipart");
		}
	}

	public function edit($id = null)
	{
		$this->form_validation->set_rules($this->services->validation_config());
		if ($this->form_validation->run() === TRUE) {
			$data['no_kk'] = $this->input->post('no_kk');
			$data['chief_name'] = $this->input->post('chief_name');
			$data['member_count'] = $this->input->post('member_count');
			$data['income'] = $this->input->post('income');

			$data['age'] = $this->input->post('age');
			$data['study'] = $this->input->post('study');
			$data['job'] = $this->input->post('job');
			
			$this->load->library('upload'); // Load librari upload
			$config = $this->services->get_photo_upload_config($data['no_kk']);

			$this->upload->initialize($config);
			// echo var_dump( $_FILES ); return;
			if ($_FILES['file_scan']['name'] != "") //if image not null
				if ($this->upload->do_upload("file_scan")) {
					$data['file_scan'] = $this->upload->data()["file_name"];
					if ($this->input->post('_file_scan') != "default.jpg")
						if (!@unlink($config['upload_path'] . $this->input->post('_file_scan')));
				} else {
					// $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
					// redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
				}
			// KTP
			$config = $this->services->get_photo_upload_config( "KTP_".$data['no_kk']);

			$this->upload->initialize($config);
			if ($_FILES['civilization_card_scan']['name'] != "")
				if ($this->upload->do_upload("civilization_card_scan")) {
					$data['civilization_card_scan'] = $this->upload->data()["file_name"];
					if ($this->input->post('_civilization_card_scan') != "default.jpg")
						if (!@unlink($config['upload_path'] . $this->input->post('_civilization_card_scan')));
				} else {
					// $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
					// redirect(site_url($this->current_page) );
				}

			$data_param['id'] = $this->input->post('id');
			if ($this->civilization_model->update($data, $data_param)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->civilization_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->civilization_model->errors()));
			}
			redirect(site_url($this->current_page."detail/".$id) );
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->civilization_model->errors() ? $this->civilization_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->civilization_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

			$this->data["civilization"] = $this->civilization_model->civilization($id)->row();
			
			$form_data_civilization = $this->services->get_form_data(null, $id);

			$this->data["image_url"] =  base_url("uploads/civilization/") ;
			$no_kk = $form_data_civilization['form_data']['no_kk']['value'];
			$form_data_civilization = $this->load->view('templates/form/plain_form', $form_data_civilization, TRUE);

			$this->data["contents"] =  $form_data_civilization;
			// $this->data["file_scan"] = (object) ["name" => $civilization->file_scan, "url" => $civilization->url_file_scan];

			##############################################################################
			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Edit Rumah ";
			$this->data["header"] = "Edit Rumah Untuk No KK " . $no_kk;
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

			$this->render("uadmin/civilization/edit");
		}
	}
	public function detail($civilization_id = null)
	{
		// $this->data["menu_list_id"] = "_aid_index";
		// $this->data["menu_list_id"] = "candidate_index";
		$this->load->library('services/Candidate_services');
		$this->services = new Candidate_services;
		if ($civilization_id == NULL) redirect(site_url($this->current_page));

		$civilization = $this->civilization_model->civilization($civilization_id)->row();
		if ($civilization == NULL) redirect(site_url($this->current_page));

		$history_table = $this->services->get_table_config_aid_history();
		$history_table["rows"] = $this->aid_model->aids_by_civilization_id($civilization->id)->result();
		$history_table = $this->load->view('templates/tables/plain_table', $history_table, true);
		$this->data["history"] =  $history_table;

		$this->data["header_button"] =  '';

		$this->load->library('services/Civilization_services');
		$this->services = new Civilization_services;

		$form_data_civilization = $this->services->get_form_data_readonly( $civilization_id);
		$form_data_civilization = $this->load->view('templates/form/plain_form_readonly_6', $form_data_civilization, TRUE);
		################################################

		$this->load->library('services/housing_services');
		$this->services = new housing_services;
		################################################
		$houses		= $this->housing_model->houses_civilization_id($civilization_id)->result();
		if (empty($houses)) { }
		
		$HOUSE_ARR = array();
		$cordinate = array();
		$i = 0;
		foreach ($houses as $house) {
			$edit_house_button = array(
				"name" => "Edit Rumah",
				"type" => "link",
				"url" => site_url( "officer/housing/edit/".$house->id),
				"button_color" => "primary",
				"data" => NULL,
			);
			
			$edit_house_button =  $this->load->view('templates/actions/link', $edit_house_button, TRUE);

			$data_house = NULL;
			$house_id	= $house->id;

			$form_data = $this->services->get_form_data_readonly($house->id, $house->civilization_id)[0];
			$form_data_1 = $this->services->get_form_data_readonly($house->id, $house->civilization_id)[1];
			$cordinate['konut_' . $i] = [$form_data_1['form_data']['longitude']['value'], $form_data_1['form_data']['latitude']['value']];

			$form_data = $this->load->view('templates/form/plain_form_readonly', $form_data, TRUE);
			$form_data_1 = $this->load->view('templates/form/plain_form_readonly_6', $form_data_1, TRUE);

			$data_house = array(
				"contents" => $form_data,
				"edit_house_button" => $edit_house_button,
				"contents_1" => $form_data_1,
				"file_scan"  => (object) ["name" => $house->file_scan, "url" => $house->url_file_scan],
				"image_url" => base_url("uploads/house/"),
				"house" => $house,
				"header" => "Detail Rumah ",
			);

			$data_house = $this->load->view('uadmin/candidate/house_template', $data_house, TRUE);
			$HOUSE_ARR[] = $data_house;
			$i++;
		}

		$this->data["HOUSE_ARR"] =  $HOUSE_ARR;
		$this->data["form_data_civilization"] = (object) [
			"block_header" => "Detail Data KK",
			"content" => $form_data_civilization,
		];

		$edit_civilization_button = array(
			"name" => "Edit KK",
			"type" => "link",
			"url" => site_url($this->current_page . "edit/".$civilization_id),
			"button_color" => "primary",
			"data" => NULL,
		);
		
		$this->data["edit_civilization_button"] =  $this->load->view('templates/actions/link', $edit_civilization_button, TRUE);

		$map = [
			'cordinate' => $cordinate,
			'zoom' => 12,
			'drag' => false
		];
		$map = $this->load->view('templates/map/multiple_map', $map, TRUE);
		##############################################################################
		$alert = $this->session->flashdata('alert');
		$this->data["map"] = $map;
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail Data " . $civilization->no_kk . " (" . $civilization->chief_name . ") ";
		$this->data["header"] = "Detail Rumah ";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

		$this->render("uadmin/civilization/detail_3");
	}

	public function delete()
	{
		if (!($_POST)) redirect(site_url($this->current_page) );

		$this->load->library('upload'); // Load librari upload
		$config = $this->services->get_photo_upload_config( time() );

		$data_param['id'] 	= $this->input->post('id');
		$house		= $this->housing_model->houses_civilization_id( $data_param['id'] )->row();

		if ($this->civilization_model->delete($data_param)) {
			if ( $this->input->post('_file_scan') != "default.jpg")
				if (!@unlink($config['upload_path'] . $this->input->post('_file_scan') )) {};
			if ($this->input->post('_civilization_card_scan') != "default.jpg")
				if (!@unlink($config['upload_path'] . $this->input->post('_civilization_card_scan'))) {};
			#######delete house
			if ($house != NULL) 
			{
				$this->load->library('services/housing_services');
				$this->services = new housing_services;
				$image_url = $this->services->get_photo_upload_config("")["upload_path"];
				if ($house->file_scan != "default.jpg")
					if (!@unlink($image_url . $house->file_scan)) { };

				$images = explode(";", $house->images);
				foreach ($images as $i => $image) :
					echo $image_url . $image . " ";
					if ($image != "default.jpg")
						if (!@unlink($image_url . $image)) { };
				endforeach;
			}

			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->civilization_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->civilization_model->errors()));
		}
		redirect(site_url($this->current_page));
	}
}
