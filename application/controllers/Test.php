$data_house['civilization_id'] 	= $civilization_id;
$data_house['category'] 			= $this->input->post('category');
$data_house['certificate_status'] = $this->input->post('certificate_status');
$data_house['rt'] 				= $this->input->post('rt');
$data_house['dusun'] 				= $this->input->post('dusun');

$data_house['land_status'] 				= $this->input->post('land_status');
$data_house['water_source'] 				= $this->input->post('water_source');
$data_house['floor_material'] 			= $this->input->post('floor_material');
$data_house['wall_material'] 				= $this->input->post('wall_material');
$data_house['roof_material'] 				= $this->input->post('roof_material');

$data_house['latitude'] 					= $this->input->post('latitude');
$data_house['longitude'] 					= $this->input->post('longitude');

$data_house['length'] 					= $this->input->post('length');
$data_house['width'] 						= $this->input->post('width');

#image
$images_arr = array();
foreach (["file_scan", "front", "back", "left", "right"] as $ind => $value) {
        if ($ind == 0) $data_house['file_scan'] = "default.jpg";
        else $images_arr[] = "default.jpg";
}
$data_house['images'] = implode(";", $images_arr);
