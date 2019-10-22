<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Civilization extends Uadmin_Controller
{
	private $services = null;
	private $name = null;
	private $parent_page = 'uadmin';
	private $current_page = 'uadmin/civilization/';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/Civilization_services');
		$this->services = new Civilization_services;
		$this->load->model(array(
			'civilization_model',
			'village_model',
		));
		$this->data["menu_list_id"] = "civilization_index";
	}
	public function index()
	{
		$this->load->library('services/Village_services');
		$this->services = new Village_services;
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $this->civilization_model->record_count();
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config_civilization($this->current_page);
		$table["rows"] = $this->village_model->villages($pagination['start_record'], $pagination['limit_per_page'])->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data["contents"] = $table;

		// $link_add = 
		// array(
		// 	"name" => "Tambah",
		// 	"type" => "link",
		// 	"url" => site_url( $this->current_page."add/"),
		// 	"button_color" => "primary",	
		// 	"data" => NULL,
		// );
		// $this->data[ "header_button" ] =  $this->load->view('templates/actions/link', $link_add, TRUE ); 
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Kartu Keluarga";
		$this->data["header"] = "Pilih Desa";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function village($village_id = NULL)
	{
		if ($village_id == NULL) redirect(site_url($this->current_page));

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $this->civilization_model->record_count_by_village_id($village_id);
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 + 1;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config($this->current_page);
		$table["rows"] = $this->civilization_model->civilizations($pagination['start_record'], $pagination['limit_per_page'], $village_id)->result();
		$table["image_url"] = $this->services->get_photo_upload_config("")["image_path"];
		// var_dump($table["rows"]); return;

		$table = $this->load->view('uadmin/civilization/plain_table_image_col', $table, true);		

		$this->data["contents"] = $table;

		// $modal_add = array(
		// 	"name" => "Tambah KK",
		// 	"modal_id" => "add_civilization_",
		// 	"button_color" => "primary",
		// 	"url" => site_url($this->current_page . "add/"),
		// 	"form_data" => $this->services->get_form_data($village_id)["form_data"],
		// 	'data' => NULL
		// );

		// $modal_add = $this->load->view('templates/actions/modal_form_multipart', $modal_add, true);

		$link_add = array(
			"name" => "Tambah KK",
			"button_color" => "primary",
			"url" => site_url($this->current_page . "add"),
			"data" => null,
			"get" => "?village_id=" . $village_id
		);

		$link_add = $this->load->view('templates/actions/link', $link_add, true);

		$this->data["header_button"] =  $link_add;		// return;
		#################################################################3
		$village 				= $this->village_model->village($village_id)->row();

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Kartu Keluarga";
		$this->data["header"] = "Daftar KK " . $village->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function add()
	{
		$village_id = $this->input->get('village_id');

		// if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		// echo var_dump( $village_id );return;
		$this->form_validation->set_rules($this->services->validation_config());
		if ($this->form_validation->run() === TRUE) {
			$data['no_kk'] = $this->input->post('no_kk');
			$data['chief_name'] = $this->input->post('chief_name');
			$data['member_count'] = $this->input->post('member_count');
			$data['income'] = $this->input->post('income');

			$data['age'] = $this->input->post('age');
			$data['study'] = $this->input->post('study');
			$data['job'] = $this->input->post('job');

			$data['village_id'] = $this->input->post('village_id');

			$this->load->library('upload'); // Load librari upload
			$config = $this->services->get_photo_upload_config($data['no_kk']);

			$this->upload->initialize($config);
			// echo var_dump( $_FILES ); return;	
			if ($_FILES['file_scan']['name'] != "")
				if ($this->upload->do_upload("file_scan")) {
					$data['file_scan'] = $this->upload->data()["file_name"];
				} else {
					$data['file_scan'] = "default.jpg";
					// $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
					// redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
				}
			// KTP
			$config = $this->services->get_photo_upload_config( "KTP_".$data['no_kk']);

			$this->upload->initialize($config);
			if ($_FILES['civilization_card_scan']['name'] != "")
				if ($this->upload->do_upload("civilization_card_scan")) {
					$data['civilization_card_scan'] = $this->upload->data()["file_name"];
				} else {
					$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
					redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
				}

			if ($this->civilization_model->create($data)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->civilization_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->civilization_model->errors()));
			}
			redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->civilization_model->errors() ? $this->civilization_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->civilization_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

			$form_data = $this->services->get_form_data($village_id);

			$form_data = $this->load->view('templates/form/plain_form', $form_data, TRUE);


			$this->data["contents"] =  $form_data;

			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Tambah Rumah ";
			$this->data["header"] = "Tambah Rumah Untuk No KK ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

			$this->data["url_form"] = $this->current_page . "add?village_id=" . $village_id;

			$this->render("templates/contents/plain_content_form_multipart");
		}
	}

	public function edit($id = null)
	{
		// if (!($_POST)) redirect(site_url($this->current_page));

		// echo var_dump( $data );return;
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
			redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->civilization_model->errors() ? $this->civilization_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->civilization_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));

			$this->data["civilization"] = $this->civilization_model->civilization($id)->row();

			$form_data = $this->services->get_form_data(null, $id);
			
			$this->data["image_url"] =  base_url("uploads/civilization/");
			$no_kk = $form_data['form_data']['no_kk']['value'];
			$form_data = $this->load->view('templates/form/plain_form', $form_data, TRUE);
			$this->data["contents"] =  $form_data;
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

	public function detail($id = null)
	{
		$this->data["civilization"] = $this->civilization_model->civilization($id)->row();

		$form_data = $this->services->get_form_data_readonly($id);
		$this->data["image_url"] =  base_url("uploads/civilization/") ;
		$no_kk = $form_data['form_data']['no_kk']['value'];
		$form_data = $this->load->view('templates/form/plain_form', $form_data, TRUE);
		$this->data["contents"] =  $form_data;

		$link_add = array(
			"name" => "Edit KK",
			"button_color" => "primary",
			"url" => site_url($this->current_page . "edit/") . $id,
		);

		$link_add = $this->load->view('templates/actions/link', $link_add, true);

		$this->data["header_button"] =  $link_add;

		##############################################################################
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail Kartu Keluarga ";
		$this->data["header"] = "Detail Kartu Keluarga " . $no_kk;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

		$this->render("uadmin/civilization/detail");
	}

	public function delete()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		$this->load->library('upload'); // Load librari upload
		$config = $this->services->get_photo_upload_config($data['no_kk']);

		$data_param['id'] 	= $this->input->post('id');
		if ($this->civilization_model->delete($data_param)) {
			if (!@unlink($config['upload_path'] . $this->input->post('_file_scan'))) {};
			if (!@unlink($config['_civilization_card_scan'] . $this->input->post('_civilization_card_scan'))) {};

			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->civilization_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->civilization_model->errors()));
		}
		redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
	}
}
