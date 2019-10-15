<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	function __construct()
	{
			parent::__construct();
	}
	public function index()
	{
		redirect(site_url( "auth/login" ));
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->render("landing_page");
	}
}