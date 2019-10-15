<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Candidate extends Uadmin_Controller
{
	private $services = null;
	private $name = null;
	private $parent_page = 'uadmin';
	private $current_page = 'uadmin/candidate/';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/Aid_services');
		$this->services = new Aid_services;
		$this->load->model(array(
			'civilization_model',
			'village_model',
			'housing_model',
			'candidate_model',
		));
		$this->data["menu_list_id"] = "candidate_index";
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

	public function candidates()
	{
		$this->data["menu_list_id"] = "candidate_candidates";
		$this->load->library('services/Candidate_services');
		$this->services = new Candidate_services;
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) ;
		$pagination['total_records'] = $this->candidate_model->record_count();
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config($this->current_page);
		$table["rows"] = $this->candidate_model->candidates($pagination['start_record'], $pagination['limit_per_page'])->result();
		// var_dump( $table["rows"] ); die;
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data["contents"] = $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Daftar Kandidat Penerima Bantuan";
		$this->data["header"] = "Daftar Kandidat Penerima Bantuan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function village( $village_id = NULL)
	{
		if ($village_id == NULL) redirect(site_url($this->current_page));

		$has_house_civilization_ids = $this->housing_model->get_civilization_id_list($village_id)->result();
		$has_house_civilization_ids = $this->services->extract_civilization_id($has_house_civilization_ids);

		$has_house = (empty($has_house_civilization_ids)) ? array() : $this->civilization_model->civilizations_by_list_id(0, NULL, $has_house_civilization_ids)->result();
		$count_all = $this->civilization_model->record_count_by_village_id($village_id);

		$candidate_rows = array();
		$candidate_rows[] = (object) ["code" => "has_house", "name" => "KK Punya Rumah", "count" => count($has_house)];
		$candidate_rows[] = (object) ["code" => "not_has_house", "name" => "KK Tidak Punya Rumah", "count" => ($count_all - count($has_house))];

		$page = ($this->uri->segment(4 +1)) ? ($this->uri->segment(4 +1) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $this->civilization_model->record_count();
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 +1;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		// echo json_encode( $this->data[ "_menus" ] ) ;return;
		$table = $this->services->get_table_config($this->current_page, NULL,  $village_id);
		$table["rows"] = $candidate_rows;
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data["contents"] = $table;
		// return;
		#################################################################3
		$village 				= $this->village_model->village($village_id)->row();

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "" . $village->name;
		$this->data["header"] = "" . $village->name; //"Olah Penerima Bantuan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function code($code = NULL)
	{
		$this->data["menu_list_id"] = "candidate_index";
		if ($code == NULL) redirect(site_url($this->current_page));
		$village_id = $this->input->get("village_id", NULL);
		$has_house_civilization_ids = $this->housing_model->get_civilization_id_list($village_id)->result();
		$has_house_civilization_ids = $this->services->extract_civilization_id($has_house_civilization_ids);
		// var_dump( $has_house_civilization_ids ); return;

		$get_data = array(
			"has_house" => array(
				"title" => "Punya Rumah",
				"count" => count($has_house_civilization_ids),
				"function" => (empty($has_house_civilization_ids)) ? array() : $this->civilization_model->civilizations_by_list_id(0, NULL, $has_house_civilization_ids, $village_id)->result(),
			),
			"not_has_house" => array(
				"title" => "Tidak Punya Rumah",
				"count" => $this->civilization_model->record_count_by_village_id($village_id) - count($has_house_civilization_ids),
				"function" => (empty($has_house_civilization_ids)) ?  $this->civilization_model->not_in_civilizations_by_list_id(0, NULL, $has_house_civilization_ids, $village_id)->result() : array(),
			)
		);
		$this->load->library('services/Civilization_services');
		$this->services = new Civilization_services;

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/index';
		$pagination['total_records'] = $get_data[$code]["count"];
		$pagination['limit_per_page'] = 10;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 + 1;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		$table = $this->services->get_table_config_candidate($this->current_page);
		$table["rows"] = $get_data[$code]["function"];

		$table = $this->load->view('templates/tables/plain_table', $table, true);

		$this->data["contents"] = $table;
		// echo var_dump($this->civilization_model->db);
		// return;
		#################################################################3
		$village 				= $this->village_model->village($village_id)->row();

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Penerima Bantuan";
		$this->data["header"] = "Daftar KK " . $get_data[$code]["title"]. " ". $village->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function detail($civilization_id = null)
	{
		$this->data["menu_list_id"] = "_aid_index";

		if ($civilization_id == NULL) redirect(site_url($this->current_page));

		$civilization = $this->civilization_model->civilization($civilization_id)->row();
		if ($civilization == NULL) redirect(site_url($this->current_page));


		$add_menu = array(
			"name" => "Jadikan Kandidat",
			"modal_id" => "add_menu_",
			"button_color" => "success",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
			  "civilization_id" => array(
				'type' => 'hidden',
				'label' => "civilization_id",
				'value' => $civilization->id,
			  ),
			  "village_id" => array(
				'type' => 'hidden',
				'label' => "village_id",
				'value' => $civilization->village_id,
			  ),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form_confirm', $add_menu, true ); 

		$this->data[ "header_button" ] =  $add_menu ;

		$this->load->library('services/Civilization_services');
		$this->services = new Civilization_services;

		$form_data_civilization = $this->services->get_form_data_readonly($civilization_id);
		$form_data_civilization = $this->load->view('templates/form/plain_form_readonly', $form_data_civilization, TRUE);
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
			$data_house = NULL;
			$house_id	= $house->id;

			$form_data = $this->services->get_form_data_readonly($house->id, $house->civilization_id);

			$cordinate['konut_' . $i] = [$form_data['form_data']['longitude']['value'], $form_data['form_data']['latitude']['value']];

			$form_data = $this->load->view('templates/form/plain_form_readonly', $form_data, TRUE);

			$data_house = array(
				"contents" => $form_data,
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

		$link_add = array(
			"name" => "Edit Rumah",
			"type" => "link",
			"url" => site_url($this->current_page . "edit/"),
			"button_color" => "primary",
			"data" => NULL,
		);
		$this->data["edit_button"] =  $this->load->view('templates/actions/link', $link_add, TRUE);;
		##############################################################################
		$alert = $this->session->flashdata('alert');
		$this->data["cordinate"] = $cordinate;
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail Rumah ";
		$this->data["header"] = "Detail Rumah ";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

		$this->render("uadmin/candidate/detail");
	}

	public function add()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		// echo var_dump( $this->input->post('civilization_id') );die;
		$this->form_validation->set_rules( "civilization_id", "civilization_id", "trim|required" );
		if ($this->form_validation->run() === TRUE) {
			$data['civilization_id'] = $this->input->post('civilization_id');
			$is_exist = $this->candidate_model->is_exist_by_civilization_id( $data['civilization_id']  );
			if( $is_exist ) 
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER,  "Data telah di masukkan dalam daftar" ));
				redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
			}

			if ($this->candidate_model->create($data)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->candidate_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->candidate_model->errors()));
			}
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->candidate_model->errors() ? $this->candidate_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->candidate_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
		}

		redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
	}

	public function delete()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		$this->load->library('upload'); // Load librari upload
		$config = $this->services->get_photo_upload_config($data['no_kk']);

		$data_param['id'] 	= $this->input->post('id');
		if ($this->candidate_model->delete($data_param)) {
			if (!@unlink($config['upload_path'] . $this->input->post('_file_scan'))) return;

			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->candidate_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->candidate_model->errors()));
		}
		redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));
	}
}
