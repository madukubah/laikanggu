
	public function add()
	{
		if (!($_POST)) redirect(site_url($this->current_page) . "village/" . $this->input->post('village_id'));

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( "civilization_id", "civilization_id", "trim|require" );
		if ($this->form_validation->run() === TRUE) {
			$data['civilization_id'] = $this->input->post('civilization_id');
		
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
