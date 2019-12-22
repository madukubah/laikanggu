<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/';
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Housing_services');
		$this->services = new Housing_services;
		$this->load->model(array(
			'civilization_model',
			'village_model',
			'housing_model',
		));
	}
	public function index()
	{
		// die;
		$this->data["village_count"] 		= $this->village_model->record_count();
		$this->data["civilization_count"] 	= $this->civilization_model->record_count();
		$this->data["livable_house_count"] 	= $this->housing_model->count_houses_by_category( 1 );
		$this->data["unlivable_house_count"] = $this->housing_model->count_houses_by_category( 0 );

		// $civilization_count = $this->civilization_model->record_count();

		$by_land_status = array(
			'chart_id'=>"by_land_status",
			'title'=>"Berdasarkan Status Lahan",
			'labels' => $this->services->land_status_select,
			'data' => [ 
				$this->housing_model->count_key_value( 'land_status', 0 ) , 
				$this->housing_model->count_key_value( 'land_status', 1 ) , 
				// 10,20
			],
			'backgroundColor' => [ 
				'rgba(65, 193, 65, 1)',
				'rgba(235,22,22,0.9)',
			 ],
		);
		$by_land_status = $this->load->view('templates/chart/pie', $by_land_status , true);
		#############
		$by_water_source = array(
			'chart_id'=>"by_water_source",
			'title'=>"Berdasarkan Sumber Air",
			'labels' => $this->services->water_source_select,
			'data' => [ 
				$this->housing_model->count_key_value( 'water_source', 0 ) , 
				$this->housing_model->count_key_value( 'water_source', 1 ) , 
				$this->housing_model->count_key_value( 'water_source', 2 ) , 
				// 10, 20, 30 
			],
			'backgroundColor' => [ 
				'rgba(65, 193, 65, 1)',
				'rgba(235,22,22,0.9)',
				'rgba(239, 239, 26, 1)',
			 ],
		);
		$by_water_source = $this->load->view('templates/chart/pie', $by_water_source , true);
		#############
		$by_light_source = array(
			'chart_id'=>"by_light_source",
			'title'=>"Berdasarkan Sumber Penerangan",
			'labels' => $this->services->light_source_select,
			'data' => [ 
				$this->housing_model->count_key_value( 'light_source', 0 ) , 
				$this->housing_model->count_key_value( 'light_source', 1 ) , 
				// 10, 20
			],
			'backgroundColor' => [ 
				'rgba(65, 193, 65, 1)',
				'rgba(235,22,22,0.9)',
			 ],
		);
		$by_light_source = $this->load->view('templates/chart/pie', $by_light_source , true);
		#############
		$by_floor_material = array(
			'chart_id'=>"by_floor_material",
			'title'=>"Berdasarkan Material Lantai Terluas",
			'labels' => $this->services->floor_material_select,
			'data' => [ 
				$this->housing_model->count_key_value( 'floor_material', 0 ) , 
				$this->housing_model->count_key_value( 'floor_material', 1 ) , 
				$this->housing_model->count_key_value( 'floor_material', 2 ) , 
				// 10, 20, 40
			],
			'backgroundColor' => [ 
				'rgba(65, 193, 65, 1)',
				'rgba(235,22,22,0.9)',
				'rgba(239, 239, 26, 1)',
			 ],
		);
		$by_floor_material = $this->load->view('templates/chart/pie', $by_floor_material , true);
		#############
		$by_wall_material = array(
			'chart_id'=>"by_wall_material",
			'title'=>"Berdasarkan Material Dinding Terluas",
			'labels' => $this->services->wall_material_select,
			'data' => [ 
				$this->housing_model->count_key_value( 'wall_material', 0 ) , 
				$this->housing_model->count_key_value( 'wall_material', 1 ) , 
				// 10, 40
			],
			'backgroundColor' => [ 
				'rgba(65, 193, 65, 1)',
				'rgba(235,22,22,0.9)',
			 ],
		);
		$by_wall_material = $this->load->view('templates/chart/pie', $by_wall_material , true);
		#############
		$by_roof_material = array(
			'chart_id'=>"by_roof_material",
			'title'=>"Berdasarkan Material Atap Terluas",
			'labels' => $this->services->roof_material_select,
			'data' => [ 
				$this->housing_model->count_key_value( 'roof_material', 0 ) , 
				$this->housing_model->count_key_value( 'roof_material', 1 ) , 
				// 30, 40
			],
			'backgroundColor' => [ 
				'rgba(65, 193, 65, 1)',
				'rgba(235,22,22,0.9)',
			 ],
		);
		$by_roof_material = $this->load->view('templates/chart/pie', $by_roof_material , true);
		#################################################################3
		$this->data['charts'] = [ $by_land_status, $by_water_source, $by_light_source, $by_floor_material, $by_wall_material, $by_roof_material ];
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Group";
		$this->data["header"] = "Group";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "admin/dashboard/content" );
	}
}