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
			'aid_model',
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

		$table = $this->services->get_table_config_housing($this->current_page);
		$table["rows"] = $this->village_model->villages($pagination['start_record'], $pagination['limit_per_page'])->result();
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		
		$this->data["contents"] = $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Calon Penerima Bantuan";
		$this->data["header"] = "Pilih Desa";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function candidates()
	{
		$village_id = $this->input->get( 'village_id', TRUE );
		$village_id || $village_id =  -1;

		$this->data["menu_list_id"] = "candidate_candidates";
		$this->load->library('services/Candidate_services');
		$this->services = new Candidate_services;
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page)."candidates";
		$pagination['total_records'] = $this->candidate_model->record_count();
		$pagination['limit_per_page'] = 100;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);

		$table = $this->services->get_table_config($this->current_page, $pagination['start_record'] + 1 );
		$table["rows"] = $this->candidate_model->candidates( $pagination['start_record'], $pagination['limit_per_page'], $village_id )->result();

		$year_select = array(
			2019 => "2019",
			2020 => "2020",
			2021 => "2021",
		);
		$modal_confirm = array(
			"name" => "Konfirmasi",
			"modal_id" => "modal_confirm",
			"button_color" => "success",
			"url" => site_url( "uadmin/aid/add" ) ,
			"form_data" => array(
				"year" => array(
					'type' => 'select',
					'label' => "Tahun Anggaran",
					"options" => $year_select
				),
				"date" => array(
					'type' => 'date',
					'label' => "Tanggal Konfirmasi",
					'value' => date("m/d/Y"),
				),
			),
			'data' => NULL
		);

		$modal_confirm = $this->load->view('templates/actions/modal_form_confirm', $modal_confirm, true);
		$this->data["form_confirm"] = $modal_confirm;

		// $table = $this->load->view('uadmin/candidate/table_form', $table, true);
		$table = $this->load->view('templates/tables/plain_table', $table, true);

		$villages = $this->candidate_model->get_village_by_candidates()->result();
		$village_select = array( -1 => "Semua Desa" );
		foreach( $villages as $village )
		{
			$village_select[ $village->id ]	= $village->name;
		}
		
		$form_filter["form_data"] = array(
				"village_id" => array(
					'type' => 'select_search',
					'label' => "Desa",
					"options" => $village_select,
					"selected" => $village_id,
				),
		);
		$form_filter["form"] = $this->load->view('templates/form/plain_form_horizontal', $form_filter, TRUE);
		$form_filter = $this->load->view('officer/filter_horizontal', $form_filter, TRUE);

		unset( $village_select[ -1 ] );
		$modal_print = array(
			"name" => "Cetak Dokumen Verifikasi",
			"modal_id" => "add_civilization_",
			"button_color" => "success",
			"url" => site_url($this->current_page . "print_verification/"), 
			"form_data" => array(
				"village_id" => array(
					'type' => 'select_search',
					'label' => "Desa",
					"options" => $village_select,
					"selected" => $village_id,
				),
			),
			'data' => NULL
		);

		$modal_print = $this->load->view('templates/actions/modal_form_blank', $modal_print, true);
		
		// var_dump( $village_id ); die;
		$this->data["header_button"] =  $modal_print;		// return;
		$this->data["contents"] = $form_filter. $table;

		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Daftar Kandidat Penerima Bantuan";
		$this->data["header"] = "Daftar Kandidat Penerima Bantuan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("uadmin/candidate/candidates");
	}

	public function village( $village_id = NULL )
	{
		$search = $this->input->get( 'search', TRUE );

		$code = 'has_house';
		$this->data["menu_list_id"] = "candidate_index";
		if ($code == NULL) redirect(site_url($this->current_page));
		#update
		// $village_id = $this->input->get("village_id", NULL);

		$has_house_civilization_ids = $this->housing_model->get_civilization_id_list($village_id)->result();
		$has_house_civilization_ids = $this->services->extract_civilization_id($has_house_civilization_ids);
		// var_dump( $has_house_civilization_ids ); return;
		$this->load->library('services/Civilization_services');
		$this->services = new Civilization_services;

		$page = ($this->uri->segment(4 + 1)) ? ($this->uri->segment(4 + 1) - 1) : 0;
		//pagination parameter
		$pagination['base_url'] = base_url($this->current_page) . '/village/'.$village_id;
		$pagination['total_records'] = $this->civilization_model->record_count_by_village_id($village_id);
		$pagination['limit_per_page'] = 100;
		$pagination['start_record'] = $page * $pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 + 1;
		//set pagination
		if ($pagination['total_records'] > 0) $this->data['pagination_links'] = $this->setPagination($pagination);
	
		$table = $this->services->get_has_house_table_config_candidate($this->current_page, $pagination['start_record'] + 1);

		if( isset( $search ) && $search != "" )
			$table[ "rows" ] = $this->civilization_model->search( $search , $village_id )->result(  );
		else
			$table["rows"] = $this->civilization_model->civilizations($pagination['start_record'], $pagination['limit_per_page'], $village_id)->result();

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

		$this->data["contents"] = $form_filter.$table;

		#################################################################3
		$village 				= $this->village_model->village($village_id)->row();

		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Olah Penerima Bantuan";
		$this->data["header"] = "Data Perumahan Tidak Layak Huni " . $village->name;
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->render("templates/contents/plain_content");
	}

	public function detail($civilization_id = null)
	{
		// $this->data["menu_list_id"] = "_aid_index";
		$this->data["menu_list_id"] = "candidate_index";
		$this->load->library('services/Candidate_services');
		$this->services = new Candidate_services;
		if ($civilization_id == NULL) redirect(site_url($this->current_page));

		$civilization = $this->civilization_model->civilization($civilization_id)->row();
		if ($civilization == NULL) redirect(site_url($this->current_page));

		$history_table = $this->services->get_table_config_aid_history();
		$history_table["rows"] = $this->aid_model->aids_by_civilization_id($civilization->id)->result();
		$history_table = $this->load->view('templates/tables/plain_table', $history_table, true);
		$this->data["history"] =  $history_table;

		$add_menu = array(
			"name" => "Jadikan Kandidat",
			"modal_id" => "add_menu_",
			"button_color" => "success",
			"url" => site_url($this->current_page . "add/"),
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
				"type_of_aid" =>  $this->services->type_of_aid()["form_data"]["type_of_aid"],
			),
			'data' => NULL
		);

		$add_menu = $this->load->view('templates/actions/modal_form', $add_menu, true);

		$this->data["header_button"] =  $add_menu;

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

			$form_data = $this->services->get_form_data_readonly($house->id, $house->civilization_id)[0];
			$form_data_1 = $this->services->get_form_data_readonly($house->id, $house->civilization_id)[1];
			$cordinate['konut_' . $i] = [$form_data_1['form_data']['longitude']['value'], $form_data_1['form_data']['latitude']['value']];

			$form_data = $this->load->view('templates/form/plain_form_readonly', $form_data, TRUE);
			$form_data_1 = $this->load->view('templates/form/plain_form_readonly_6', $form_data_1, TRUE);

			$data_house = array(
				"contents" => $form_data,
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

		$link_add = array(
			"name" => "Edit Rumah",
			"type" => "link",
			"url" => site_url($this->current_page . "edit/"),
			"button_color" => "primary",
			"data" => NULL,
		);
		$map = [
			'cordinate' => $cordinate,
			'zoom' => 12,
			'drag' => false
		];
		$map = $this->load->view('templates/map/multiple_map', $map, TRUE);
		$this->data["edit_button"] =  $this->load->view('templates/actions/link', $link_add, TRUE);;
		##############################################################################
		$alert = $this->session->flashdata('alert');
		// $this->data["map"] = $map;
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Detail Rumah " . $civilization->no_kk . " (" . $civilization->chief_name . ") ";
		$this->data["header"] = "Detail Rumah ";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

		$this->data["url_form"] = ""; // $this->current_page."add/?no_kk=".$no_kk."&village_id=".$village_id;

		$this->render("uadmin/candidate/detail");
	}

	public function add()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		// echo var_dump( $this->input->post('civilization_id') );die;
		$this->form_validation->set_rules("civilization_id", "civilization_id", "trim|required");
		if ($this->form_validation->run() === TRUE) {
			$data['civilization_id'] = $this->input->post('civilization_id');
			$data['type_of_aid'] = $this->input->post('type_of_aid');
			$is_exist = $this->candidate_model->is_exist_by_civilization_id($data['civilization_id']);
			if ($is_exist) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER,  "Data telah di masukkan dalam daftar"));
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

	public function edit()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		// echo var_dump( $this->input->post('civilization_id') );die;
		$this->form_validation->set_rules("id", "id", "trim|required");
		if ($this->form_validation->run() === TRUE) {
			$data['type_of_aid'] = $this->input->post('type_of_aid');
			$data_param['id'] = $this->input->post('id');
			

			if ($this->candidate_model->update($data, $data_param)) {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->candidate_model->messages()));
			} else {
				$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->candidate_model->errors()));
			}
		} else {
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->candidate_model->errors() ? $this->candidate_model->errors() : $this->session->flashdata('message')));
			if (validation_errors() || $this->candidate_model->errors()) $this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->data['message']));
		}

		redirect(site_url($this->current_page) . "candidates" );
	}

	public function delete()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "candidates/");

		$data_param['id'] 	= $this->input->post('id');
		if ($this->candidate_model->delete($data_param)) {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->candidate_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->candidate_model->errors()));
		}
		redirect(site_url($this->current_page) . "candidates/");
	}

	public function print_verification()
	{
		$village_id = $this->input->post( 'village_id' );
		$village_id || $village_id =  -1;
		if( $village_id == -1 ) redirect(site_url($this->current_page) . "candidates/");

		$village         = $this->village_model->village($village_id)->row();
		$rows = $this->candidate_model->get_candidates_for_verification( 0, NULL, $village_id )->result();
		// var_dump( $rows ); die;

		$this->load->library('pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		$pdf->SetTitle("Laporan Bantuan");

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetTopMargin(10);
		$pdf->SetLeftMargin(10);
		$pdf->SetRightMargin(10);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('PERUMAHAN');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$cover[ "title" ] = "Daftar Kandidat Penerima Bantuan Rumah Tidak Layak Huni ".$village->name;
		$html = $this->load->view('templates/report/cover', $cover, true);
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->AddPage();
		$html = "";
		$this->load->library('services/housing_services');
		$this->services = new housing_services;
		$i = 1;
		$y = 0;
		foreach( $rows as $ind => $row )
		{
			$data = NULL;
			$row->floor_material  	= $this->services->floor_material_select[ $row->floor_material ];
			$row->land_status  		= $this->services->land_status_select[ $row->land_status ];
			$row->water_source  	= $this->services->water_source_select[ $row->water_source ];
			$row->light_source  	= $this->services->light_source_select[ $row->light_source ];
			$row->wall_material  	= $this->services->wall_material_select[ $row->wall_material ];
			$row->roof_material  	= $this->services->roof_material_select[ $row->roof_material ];

			$data[ "house" ] = $row;

			$images = explode(";", $row->images);
			// $img = file_get_contents( base_url()."uploads/house/".$images[0]  );
			$default = file_get_contents( base_url()."uploads/house/default.jpg" );
			if( $images[0] != "default.jpg" )
				$images[0] = file_get_contents( base_url()."uploads/house/".$images[0]  );
			else $images[0] = $default;
			if( $images[1] != "default.jpg" )
				$images[1] = file_get_contents( base_url()."uploads/house/".$images[1]  );
			else $images[1] = $default;
			if( $images[3] != "default.jpg" )
				$images[3] = file_get_contents( base_url()."uploads/house/".$images[3]  );
			else $images[3] = $default;

			$pdf->Image('@' . $images[0],  15			, 50 + $y, 60, 40, 'JPG', '#', '', true, 150, '', false, false, 1, false, false, false);
			$pdf->Image('@' . $images[1],  15 + 60		, 50 + $y, 60, 40, 'JPG', '#', '', true, 150, '', false, false, 1, false, false, false);
			$pdf->Image('@' . $images[3],  15 + 60 + 60	, 50 + $y, 60, 40, 'JPG', '#', '', true, 150, '', false, false, 1, false, false, false);

			// $html .= $this->load->view('templates/report/candidates', $data, true);
			$pdf->writeHTML( $this->load->view('templates/report/candidates', $data, true) , true, false, true, false, '');
			$y += 87;
			if( $i % 3 == 0 )
			{
				// $pdf->writeHTML($html, true, false, true, false, '');
				$pdf->AddPage();
				$html = "";
				$y = 0;
			}
			$i++;
		}
		// $pdf->AddPage();
		$pdf->SetFont('times', NULL, 9);
		// $html = $this->load->view('templates/report/candidates', $this->data, true);
		// $pdf->writeHTML($html, true, false, true, false, '');
		$title = str_replace(" ", "_", "asd" );
		//sleep ( 15 );
		$pdf->Output($title . ".pdf", 'I');
	}
}
