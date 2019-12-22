<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Housing extends Uadmin_Controller
{
	private $services = null;
	private $name = null;
	private $parent_page = 'uadmin';
	private $current_page = 'uadmin/housing/';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/housing_services');
		$this->services = new housing_services;
		$this->load->model(array(
			'housing_model',
			'village_model',
			'civilization_model',
		));
		$this->data["menu_list_id"] = "housing_index";
	}

	public function upload_photo()
	{
		$image_name = ["front", "back", "left", "right"];
		$name = $image_name[$this->input->post('image_index')];

		$house_id = $this->input->post('house_id');
		$house = $this->housing_model->house($house_id)->row();
		// upload photo		
		$this->load->library('upload'); // Load librari upload
		$config = $this->services->get_photo_upload_config($name);

		$this->upload->initialize($config);
		// echo var_dump( $_FILES['images'] ); return;
		// if( $_FILES['image']['name'] != "" )
		if ($this->upload->do_upload("image")) {
			$image		 	= $this->upload->data()["file_name"];

			if ($this->input->post('old_image') != "default.jpg")
				if (!@unlink($config['upload_path'] . $this->input->post('old_image'))) { };

			$images = explode(";", $house->images);

			$images[$this->input->post('image_index')] = $image;
			$data['images'] 	= implode(";", $images);
		} else {
			// $data['image'] = "default.png";
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
			redirect(site_url($this->current_page) . "edit/" . $house->id);
		}

		$data_param["id"] = $this->input->post('house_id');
		// echo var_dump( $data ); return ;
		if ($this->housing_model->update($data, $data_param)) {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->housing_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->housing_model->errors()));
		}

		redirect(site_url($this->current_page) . "edit/" . $house->id);
	}

	public function index()
	{
		$this->load->library('services/Village_services');
		$this->services = new Village_services;
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $this->village_model->record_count();
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config_housing($this->current_page);
		$table["rows"] = $this->village_model->villages($pagination['start_record'], $pagination['limit_per_page'])->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data["contents"] = $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Perumahan";
		$this->data["header"] = "Pilih Desa";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function village($village_id = NULL)
	{
		$search = $this->input->get('search', TRUE);

		if ($village_id == NULL) redirect(site_url($this->current_page));

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $this->housing_model->record_count_by_village_id($village_id);
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 + 1;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		$table = $this->services->get_table_config($this->current_page);
		if (isset($search) && $search != "")
			$table["rows"] = $this->housing_model->search($search, $village_id)->result();
		else
			$table["rows"] = $this->housing_model->houses($pagination['start_record'], $pagination['limit_per_page'], $village_id)->result();

		$table["image_url"] = $this->services->get_photo_upload_config("")["image_path"];

		$table = $this->load->view('uadmin/housing/plain_table', $table, true);

		$form_filter["form_data"] = array(
			"search" => array(
				'type' => 'text',
				'label' => "No KK",
				'value' => $search
			),
		);
		$form_filter["form"] = $this->load->view('templates/form/plain_form_horizontal', $form_filter, TRUE);
		$form_filter = $this->load->view('officer/filter_horizontal', $form_filter, TRUE);

		$this->data["contents"] = $form_filter . $table;

		$modal_add = array(
			"name" => "Tambah Rumah",
			"modal_id" => "add_civilization_",
			"button_color" => "primary",
			"url" => site_url($this->current_page . "add/"),
			"form_data" => array(
				"no_kk" => array(
					'type' => 'text',
					'label' => "Masukkan No KK",
				),
				"village_id" => array(
					'type' => 'hidden',
					'label' => "Masukkan No KK",
					'value' => $village_id,
				),
			),
			'data' => NULL
		);

		$modal_add = $this->load->view('templates/actions/modal_form_get', $modal_add, true);

		$this->data["header_button"] =  $modal_add;
		#################################################################3
		$village 				= $this->village_model->village($village_id)->row();

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Perumahan";
		$this->data["header"] = "Daftar Rumah " . $village->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}


	public function add()
	{
		$no_kk = $this->input->get("no_kk", NULL);
		$village_id = $this->input->get("village_id", NULL);
		if ($no_kk == NULL) redirect(site_url($this->current_page));

		$civilization = $this->civilization_model->civilization_by_no_kk_and_village_id($no_kk, $village_id)->row();
		if ($civilization == NULL) {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, "Data Tidak di temukan"));
			redirect(site_url($this->current_page) . "village/" . $village_id);
		}
		// echo var_dump( $this->civilization_model->db );return;

		$this->form_validation->set_rules($this->services->validation_config());
		if ($this->form_validation->run() === TRUE) {
			$data['civilization_id'] 	= $this->input->post('civilization_id');
			$data['category'] 			= $this->input->post('category');
			$data['certificate_status'] = $this->input->post('certificate_status');
			$data['rt'] 				= $this->input->post('rt');
			$data['dusun'] 				= $this->input->post('dusun');

			$data['land_status'] 				= $this->input->post('land_status');
			$data['water_source'] 				= $this->input->post('water_source');
			$data['floor_material'] 				= $this->input->post('floor_material');
			$data['wall_material'] 				= $this->input->post('wall_material');
			$data['roof_material'] 				= $this->input->post('roof_material');

			$data['latitude'] 					= $this->input->post('latitude');
			$data['longitude'] 					= $this->input->post('longitude');

			$data['length'] 					= $this->input->post('length');
			$data['width'] 						= $this->input->post('width');

			$this->load->library('upload'); // Load librari upload
			$config = $this->services->get_photo_upload_config($data['no_kk'] = "");

			$images_arr = array();
			foreach (["file_scan", "front", "back", "left", "right"] as $ind => $value) {
				$config["file_name"] = $value . "_" . time();
				// echo $config[ "file_name" ]."<br>";
				$this->upload->initialize($config);
				if ($this->upload->do_upload($value)) {
					if ($ind == 0) $data['file_scan'] = $this->upload->data()["file_name"];
					else $images_arr[] = $this->upload->data()["file_name"];
				} else {
					if ($ind == 0) $data['file_scan'] = "default.jpg";
					else $images_arr[] = "default.jpg";
				}
			}
			$data['images'] = implode(";", $images_arr);
			// echo json_encode( $data );return;

			if ($this->housing_model->create($data)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->housing_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->housing_model->errors()));
			}
			redirect(site_url($this->current_page) . "village/" . $village_id);
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->housing_model->errors() ? $this->housing_model->errors() : $this->session->flashdata('message')));
			if (!empty(validation_errors()) || $this->housing_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

			$form = $this->services->get_form_data(NULL, $civilization->id);

			$form_data = $form[0];
			$form_data = $this->load->view('templates/form/plain_form_6', $form_data, TRUE);

			$form_data_1 = $form[1];
			$form_data_1 = $this->load->view('templates/form/plain_form', $form_data_1, TRUE);

			$form_data_2 = $form[2];
			$form_data_2 = $this->load->view('templates/form/plain_form_6', $form_data_2, TRUE);

			$form_data_3 = $form[3];
			$form_data_3 = $this->load->view('templates/form/plain_form_6', $form_data_3, TRUE);

			$this->data["contents"] =  $form_data . $form_data_1 . $form_data_2 . "<br>" . $form_data_3;
			$config_map = [
				'cordinate' => array(
					'konut_0' => [122.10348308181318, -3.5014330835094682],
				),
				'zoom' => 13
			];
			$this->data["map"] = $this->load->view('templates/map/map', $config_map, TRUE);

			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah Rumah ";
			$this->data["header"] = "Tambah Rumah Untuk No KK " . $civilization->no_kk;
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			$this->data["url_form"] = $this->current_page . "add/?no_kk=" . $no_kk . "&village_id=" . $village_id;

			$this->render("uadmin/housing/plain_content_form");
		}
	}
	public function detail($house_id = null)
	{
		if ($house_id == NULL) redirect(site_url($this->current_page));

		$house 				= $this->housing_model->house($house_id)->row();

		$civilization = $this->civilization_model->civilization($house->civilization_id)->row();
		if ($civilization == NULL) redirect(site_url($this->current_page));

		$form_data = $this->services->get_form_data_readonly($house->id, $house->civilization_id);

		$latitude = $form_data['form_data']['latitude']['value'];
		$longitude = $form_data['form_data']['longitude']['value'];

		$form_data_1 = $this->load->view('templates/form/plain_form_readonly', $form_data, TRUE);
		$form_data = $this->load->view('templates/form/plain_form_readonly_6', $form_data, TRUE);

		$this->data["contents"] =  $form_data;
		$this->data["form_data_1"] =  $form_data_1;
		$this->data["file_scan"] = (object) ["name" => $house->file_scan, "url" => $house->url_file_scan];
		$this->data["image_url"] =  base_url("uploads/house/");
		$this->data["house"] =  $house;

		$link_add = array(
			"name" => "Edit Rumah",
			"type" => "link",
			"url" => site_url($this->current_page . "edit/" . $house_id),
			"button_color" => "primary",
			"data" => NULL,
		);
		$this->data["edit_button"] =  $this->load->view('templates/actions/link', $link_add, TRUE);;
		$config_map = [
			'cordinate' => array(
				'konut_0' => [$longitude, $latitude],
			),
			'zoom' => 14
		];
		$this->data["map"] = $this->load->view('templates/map/map', $config_map, TRUE);
		##############################################################################

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail Rumah ";
		$this->data["header"] = "Detail Rumah Untuk No KK " . $civilization->no_kk;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

		$this->render("uadmin/housing/detail");
	}
	public function edit($house_id = null)
	{
		if ($house_id == NULL) redirect(site_url($this->current_page));
		$house 				= $this->housing_model->house($house_id)->row();

		$civilization = $this->civilization_model->civilization($house->civilization_id)->row();
		if ($civilization == NULL) redirect(site_url($this->current_page));

		$this->form_validation->set_rules($this->services->validation_config());
		if ($this->form_validation->run() === TRUE) {
			// $data['id'] 		= $this->input->post( 'id' );
			$data['civilization_id'] 		= $this->input->post('civilization_id');
			$data['category'] 					= $this->input->post('category');
			$data['certificate_status'] = $this->input->post('certificate_status');
			$data['rt'] 						= $this->input->post('rt');
			$data['dusun'] 						= $this->input->post('dusun');

			$data['land_status'] 				= $this->input->post('land_status');
			$data['water_source'] 				= $this->input->post('water_source');
			$data['floor_material'] 			= $this->input->post('floor_material');
			$data['wall_material'] 				= $this->input->post('wall_material');
			$data['roof_material'] 				= $this->input->post('roof_material');

			$data['latitude'] 					= $this->input->post('latitude');
			$data['longitude'] 					= $this->input->post('longitude');

			$data['length'] 					= $this->input->post('length');
			$data['width'] 						= $this->input->post('width');
			// echo json_encode( $data );return;

			$this->load->library('upload'); // Load librari upload
			$config = $this->services->get_photo_upload_config($data['no_kk'] = "");

			// echo json_encode( $_FILES ); return;
			if ($_FILES['file_scan']['name'] != "")
				foreach (["file_scan"] as $ind => $value) {
					$config["file_name"] = $value . "_" . time();
					$this->upload->initialize($config);
					if ($this->upload->do_upload($value)) {
						$data['file_scan'] = $this->upload->data()["file_name"];
						if ($this->input->post('_file_scan') != "default.jpg")
							if (!@unlink($config['upload_path'] . $this->input->post('_file_scan')));
					} else {
						$data['file_scan'] = "default.jpg";
					}
				}

			$data_param["id"] 	= $this->input->post('id');
			if ($this->housing_model->update($data, $data_param)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->housing_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->housing_model->errors()));
			}
			redirect(site_url($this->current_page) . "village/" . $civilization->village_id);
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->housing_model->errors() ? $this->housing_model->errors() : $this->session->flashdata('message')));
			if (!empty(validation_errors()) || $this->housing_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

			$images = explode(";", $house->images);
			$images_arr = array();
			$image_url = $this->services->get_photo_upload_config("")["image_path"];
			foreach ($images as $i => $image) :
				$edit_photo = array(
					"name" => "Ganti Gambar",
					"modal_id" => "edit_photo_" . $i,
					"button_color" => "primary",
					"url" => site_url($this->current_page . "upload_photo/"),
					"form_data" => array(

						"image" => array(
							'type' => 'file',
							'label' => "Foto",
							'value' => "",
						),
						"name" => array(
							'type' => 'hidden',
							'label' => "house_id",
							'value' => substr($image, 0, strpos($image, ".")),
						),
						"house_id" => array(
							'type' => 'hidden',
							'label' => "house_id",
							'value' => $house->id,
						),
						"image_index" => array(
							'type' => 'hidden',
							'label' => "image_index",
							'value' => $i,
						),
						"old_image" => array(
							'type' => 'hidden',
							'label' => "old_image",
							'value' => $image,
						),
						'data' => NULL
					),
				);

				$edit_photo_html = $this->load->view('templates/actions/modal_form_multipart', $edit_photo, true);
				$images_arr[] = (object) array(
					"image_url" 		=> $image_url . $image,
					"edit_photo_html" 	=> $edit_photo_html,
				);
			endforeach;

			$form = $this->services->get_form_data($house->id, $house->civilization_id);
			$form_data = $form[0];
			$form_data_3 = $form[3];
			$form_data_1 = $form[1];

			$latitude = $form_data_3['form_data']['latitude']['value'];
			$longitude = $form_data_3['form_data']['longitude']['value'];

			$form_data = $this->load->view('templates/form/plain_form', $form_data, TRUE);
			$form_data_1 = $this->load->view('templates/form/plain_form', $form_data_1, TRUE);
			$form_data_3 = $this->load->view('templates/form/plain_form', $form_data_3, TRUE);

			$this->data["contents"] =  $form_data . $form_data_3 . $form_data_1;
			$this->data["file_scan"] = (object) ["name" => $house->file_scan, "url" => $house->url_file_scan];
			$this->data["image_url"] =  base_url("uploads/house/");
			$this->data["house"] =  $house;
			$this->data["images_arr"] =  $images_arr;


			$link_add = array(
				"name" => "Edit Rumah",
				"type" => "link",
				"url" => site_url($this->current_page . "edit/" . $house_id),
				"button_color" => "primary",
				"data" => NULL,
			);
			$this->data["edit_button"] = "";
			$config_map = [
				'cordinate' => array(
					'konut_0' => [$longitude, $latitude],
				),
				'zoom' => 14
			];
			$this->data["map"] = $this->load->view('templates/map/map', $config_map, TRUE);
			##############################################################################
			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Edit Rumah ";
			$this->data["header"] = "Edit Rumah Untuk No KK " . $civilization->no_kk;
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

			$this->render("uadmin/housing/edit");
		}
		####################################################################

	}

	public function delete()
	{
		if (!($_POST)) redirect(site_url($this->current_page));

		$data_param['id'] 	= $this->input->post('id');

		$house = $this->housing_model->house($data_param['id'])->row();
		if ($house == NULL) redirect(site_url($this->current_page));

		if ($this->housing_model->delete($data_param)) {
			$image_url = $this->services->get_photo_upload_config("")["upload_path"];
			if ($house->file_scan != "default.jpg")
				if (!@unlink($image_url . $house->file_scan)) { };

			$images = explode(";", $house->images);
			foreach ($images as $i => $image) :
				echo $image_url . $image . " ";
				if ($image != "default.jpg")
					if (!@unlink($image_url . $image)) { };
			endforeach;
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->housing_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->housing_model->errors()));
		}
		redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
	}
}
