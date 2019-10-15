<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/';
	public function __construct(){
		parent::__construct();
		$this->load->model(array(
			'civilization_model',
		));
	}
	public function index()
	{
		
		
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
