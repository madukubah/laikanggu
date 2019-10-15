<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Housing_services
{
  protected $id;
  protected $civilization_id;
  protected $category;
  protected $certificate_status;
  protected $rt;
  protected $dusun;
  protected $images;
  protected $latitude;
  protected $longitude;
  protected $file_scan;

  protected $floor_material;
  protected $floor_material_select = array(
    "PLESTERAN", "UBIN/TEGEL", "KAYU"
  );
  protected $wall_material;
  protected $wall_material_select = array(
    "KAYU", "TEMBOK"
  );
  protected $roof_material;
  protected $roof_material_select = array(
    "SENG", "JERAMI"
  );
  protected $light_source;
  protected $light_source_select = array(
    "LISTRIK PLN DENGAN METERAN", "BUKAN LISTRIK"
  );
  protected $water_source;
  protected $water_source_select = array(
    "MATA AIR", "SUMUR GALI", "SUNGAI"
  );
  protected $land_status	;
  protected $land_status_select =array(
    "MILIK SENDIRI", "BUKAN MILIK SENDIRI"
  );
  protected $category_select = array(
    0 => "Tidak Layak Huni",
    1 => "Layak Huni",
  );
  protected $certificate_status_select = array(
    0 => "Tidak",
    1 => "Ya",
    2 => "Hak Pakai Tanah",
  );

  function __construct()
  {
    $this->id                 = '';
    $this->civilization_id    = '';
    $this->category           = "";
    $this->certificate_status = "";
    $this->rt                 = "2";
    $this->dusun              = "3";
    $this->images             = "";
    $this->latitude           = "-3.5014330835094682";
    $this->longitude          = "122.10348308181318";
    $this->file_scan          = "";

    $this->floor_material     = 0;
    $this->wall_material      = 0;
    $this->roof_material      = 0;
    $this->light_source       = 0;
    $this->water_source       = 0;
    $this->land_status        = 0;
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function get_photo_upload_config($name = "_")
  {
    $filename = $name . "_" . time();
    $upload_path = 'uploads/house/';

    $config['upload_path'] = './' . $upload_path;
    $config['image_path'] = base_url() . $upload_path;
    $config['allowed_types'] = "gif|jpg|png|jpeg";
    $config['overwrite'] = "true";
    $config['max_size'] = "2048";
    $config['file_name'] = '' . $filename;

    return $config;
  }

  public function get_table_config($_page, $start_number = 1)
  {
    $table["header"] = array(
      'no_kk' => 'Nomor KK',
      'category' => 'Kategori Rumah',
      'certificate_status' => 'Bersertifikat',
      'address' => 'Alamat',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
      array(
        "name" => "Detail",
        "type" => "link",
        "url" => site_url($_page . "detail/"),
        "button_color" => "primary",
        "param" => "id",
      ),
      array(
        "name" => 'X',
        "type" => "modal_delete",
        "modal_id" => "delete_",
        "url" => site_url($_page . "delete/"),
        "button_color" => "danger",
        "param" => "id",
        "form_data" => array(
          "id" => array(
            'type' => 'hidden',
            'label' => "id",
          ),
          "village_id" => array(
            'type' => 'hidden',
            'label' => "village_id",
          ),
        ),
        "title" => "KK",
        "data_name" => "no_kk",
      ),
    );
    return $table;
  }
  public function validation_config()
  {
    $config = array(
      array(
        'field' => 'civilization_id',
        'label' => 'civilization_id',
        'rules' =>  'trim|required',
      ),
    );

    return $config;
  }
  /**
   * get_form_data
   *
   * @return array
   * @author madukubah
   **/
  public function get_form_data_readonly($house_id = NULL, $civilization_id = NULL)
  {
    $this->civilization_id    = $civilization_id;
    if (isset($house_id)) {
      $this->load->model(array(
        'housing_model',
      ));
      $house         = $this->housing_model->house($house_id)->row();

      $this->id                  = $house->id;
      $this->civilization_id    = $civilization_id;
      $this->category            = $house->category;
      $this->certificate_status  = $house->certificate_status;
      $this->rt                  = $house->rt;
      $this->dusun              = $house->dusun;
      $this->images              = $house->images;
      $this->latitude            = $house->latitude;
      $this->longitude          = $house->longitude;
      $this->file_scan          = $house->file_scan;

      $this->floor_material          = $house->floor_material;
      $this->wall_material          = $house->wall_material;
      $this->roof_material          = $house->roof_material;
      $this->light_source          = $house->light_source;
      $this->water_source          = $house->water_source;
      $this->land_status          = $house->land_status;
    }

    $_data["form_data"] = array(
      "id" => array(
        'type' => 'hidden',
        'label' => "ID",
        'value' => $this->form_validation->set_value('id', $this->id),
      ),
      "civilization_id" => array(
        'type' => 'hidden',
        'label' => "civilization_id",
        'value' => $this->form_validation->set_value('civilization_id', $this->civilization_id),
      ),
      "category" => array(
        'type' => 'text',
        'label' => "Kategori",
        'value' => $this->category_select[$this->category],
      ),
      "certificate_status" => array(
        'type' => 'text',
        'label' => "Bersertifikat",
        'value' => $this->certificate_status_select[$this->certificate_status],
      ),
      "rt" => array(
        'type' => 'text',
        'label' => "RT",
        'value' => $this->form_validation->set_value('rt', $this->rt),
      ),
      "dusun" => array(
        'type' => 'text',
        'label' => "Dusun",
        'value' => $this->form_validation->set_value('dusun', $this->dusun),
      ),
      "land_status" => array(
        'type' => 'text',
        'label' => "Status Tanah",
        "value" => $this->land_status_select[ $this->land_status ],
      ),
      "water_source" => array(
        'type' => 'text',
        'label' => "Sumber Air",
        "value" => $this->water_source_select[ $this->water_source ],
      ),
      "floor_material" => array(
        'type' => 'text',
        'label' => "Material Lantai Terluas",
        "value" => $this->floor_material_select[ $this->floor_material ],
      ),
      "wall_material" => array(
        'type' => 'text',
        'label' => "Material Dinding Terluas",
        "value" => $this->wall_material_select[ $this->wall_material ],
      ),
      "roof_material" => array(
        'type' => 'text',
        'label' => "Material Atap Terluas",
        "value" => $this->roof_material_select[ $this->roof_material ],
      ),
      "latitude" => array(
        'type' => 'text',
        'label' => "Latitude",
        'value' => $this->form_validation->set_value('latitude', $this->latitude),
      ),
      "longitude" => array(
        'type' => 'text',
        'label' => "Longitude",
        'value' => $this->form_validation->set_value('longitude', $this->longitude),
      ),

    );
    return $_data;
  }
  /**
   * get_form_data
   *
   * @return array
   * @author madukubah
   **/
  public function get_form_data($house_id = NULL, $civilization_id = NULL)
  {
    $this->civilization_id    = $civilization_id;
    if (isset($house_id)) {
      $this->load->model(array(
        'housing_model',
      ));
      $house         = $this->housing_model->house($house_id)->row();

      $this->id                  = $house->id;
      $this->civilization_id    = $civilization_id;
      $this->category            = $house->category;
      $this->certificate_status  = $house->certificate_status;
      $this->rt                  = $house->rt;
      $this->dusun              = $house->dusun;
      $this->images              = $house->images;
      $this->latitude            = $house->latitude;
      $this->longitude          = $house->longitude;
      $this->file_scan          = $house->file_scan;

      $this->floor_material          = $house->floor_material;
      $this->wall_material          = $house->wall_material;
      $this->roof_material          = $house->roof_material;
      $this->light_source          = $house->light_source;
      $this->water_source          = $house->water_source;
      $this->land_status          = $house->land_status;
    }

    $_data[0]["form_data"] = array(
      "id" => array(
        'type' => 'hidden',
        'label' => "ID",
        'value' => $this->form_validation->set_value('id', $this->id),
      ),
      "civilization_id" => array(
        'type' => 'hidden',
        'label' => "civilization_id",
        'value' => $this->form_validation->set_value('civilization_id', $this->civilization_id),
      ),
      "category" => array(
        'type' => 'select',
        'label' => "Kategori",
        'options' => $this->category_select,
        'selected' => $this->form_validation->set_value('category', $this->category),
      ),
      "certificate_status" => array(
        'type' => 'select',
        'label' => "Bersertifikat",
        'options' => $this->certificate_status_select,
        'selected' => $this->form_validation->set_value('certificate_status', $this->certificate_status),
      ),
      "rt" => array(
        'type' => 'text',
        'label' => "RT",
        'value' => $this->form_validation->set_value('rt', $this->rt),
      ),
      "dusun" => array(
        'type' => 'text',
        'label' => "Dusun",
        'value' => $this->form_validation->set_value('dusun', $this->dusun),
      ),
      "land_status" => array(
        'type' => 'select',
        'label' => "Status Lahan",
        "options" => $this->land_status_select,
        "selected" => $this->land_status,
      ),
      "water_source" => array(
        'type' => 'select',
        'label' => "Sumber Air",
        "options" => $this->water_source_select,
        "selected" => $this->water_source,
      ),
      "floor_material" => array(
        'type' => 'select',
        'label' => "Material Lantai Terluas",
        "options" => $this->floor_material_select,
        "selected" => $this->floor_material,
      ),
      "wall_material" => array(
        'type' => 'select',
        'label' => "Material Dinding Terluas",
        "options" => $this->wall_material_select,
        "selected" => $this->wall_material,
      ),
      "roof_material" => array(
        'type' => 'select',
        'label' => "Material Atap Terluas",
        "options" => $this->roof_material_select,
        "selected" => $this->roof_material,
      ),

    );
    $_data[1]["form_data"] = array(
      "file_scan" => array(
        'type' => 'file',
        'label' => "File Scan Sertifikat ( JPG atau PNG ) ( Optional )",
      ),
      "_file_scan" => array(
        'type' => 'hidden',
        'label' => "File Scan KK ( JPG atau PNG )",
        'value' => $this->file_scan,
      ),
    );
    $_data[2]["form_data"] = array(
      "front" => array(
        'type' => 'file',
        'label' => "Gambar Depan Rumah",
      ),
      "back" => array(
        'type' => 'file',
        'label' => "Gambar Belakang  Rumah",
      ),
      "left" => array(
        'type' => 'file',
        'label' => "Gambar kiri Rumah",
      ),
      "right" => array(
        'type' => 'file',
        'label' => "Gambar Kanan Rumah",
      ),
    );
    $_data[3]["form_data"] = array(
      "latitude" => array(
        'type' => 'text',
        'label' => "Latitude",
        'value' => $this->form_validation->set_value('latitude', $this->latitude),
      ),
      "longitude" => array(
        'type' => 'text',
        'label' => "Longitude",
        'value' => $this->form_validation->set_value('longitude', $this->longitude),
      ),
    );

    return $_data;
  }
}
