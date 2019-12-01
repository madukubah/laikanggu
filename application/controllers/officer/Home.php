<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Officer_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'officer';
	private $current_page = 'officer/';
	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'civilization_model',
			'housing_model',
		));
		// echo var_dump( $this->data["village"] );die;
	}
	
	public function index()
	{
		$village = $this->data["village"];
		$village_id = $village->id;

		$this->data["civilization_count"]  = $this->civilization_model->record_count_by_village_id( $village_id );
		$this->data["livable_house_count"] 	= $this->housing_model->count_houses_by_category( 1 );
		$this->data["unlivable_house_count"] = $this->housing_model->count_houses_by_category( 0 );
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Group";
		$this->data["header"] = "Group";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "officer/dashboard/content" );
	}
}
