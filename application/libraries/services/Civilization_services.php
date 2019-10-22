<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Civilization_services
{
  protected $id;
  protected $no_kk;
  protected $chief_name;
  protected $member_count;
  protected $income;
  protected $job;
  protected $age;
  protected $study;

  protected $file_scan;
  protected $_file_scan;

  protected $civilization_card_scan;
  protected $_civilization_card_scan;

  function __construct()
  {
    $this->id          = '';
    $this->no_kk    = '';
    $this->chief_name  = "";
    $this->member_count  = "";
    $this->income  = "";
    $this->job  = "";
    $this->age  = "";
    $this->study	  = "";

    $this->file_scan      = "";
    $this->_file_scan     = "";

    $this->civilization_card_scan     = "";
    $this->_civilization_card_scan     = "";
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function get_photo_upload_config($name = "_")
  {
    $filename = "Civilization_" . $name . "_" . time();
    $upload_path = 'uploads/civilization/';

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
      'chief_name' => 'Kepala Keluarga',
      'member_count' => 'Anggota Keluarga',
      'income' => 'Pendapatan / bulan',
      'images' => 'Scan KK',
      'civilization_card_scan' => 'Scan KTP',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
      // array(
      //   "name" => "Edit KK",
      //   "type" => "modal_form_multipart",
      //   "modal_id" => "edit_civilization_",
      //   "button_color" => "primary",
      //   "url" => site_url($_page . "edit/"),
      //   "param" => "id",
      //   "form_data" => $this->get_form_data(null)["form_data"],
      // ),
      array(
        "name" => "Detail",
        "type" => "link",
        "button_color" => "primary",
        "url" => site_url($_page . "detail/"),
        "param" => "id",
      ),
      // array(
      //   "name" => "Edit KK",
      //   "type" => "link",
      //   "button_color" => "primary",
      //   "url" => site_url($_page . "edit/"),
      //   "param" => "id",
      // ),
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
          "_file_scan" => array(
            'type' => 'hidden',
            'label' => "_file_scan",
          ),
          "_civilization_card_scan" => array(
            'type' => 'hidden',
            'label' => "_civilization_card_scan",
          ),
        ),
        "title" => "KK",
        "data_name" => "no_kk",
      ),
    );
    return $table;
  }

  public function get_table_config_candidate($_page, $start_number = 1)
  {
    $table["header"] = array(
      'no_kk' => 'Nomor KK',
      'chief_name' => 'Kepala Keluarga',
      'member_count' => 'Anggota Keluarga',
      'income' => 'Pendapatan / bulan',

    );
    $table["number"] = $start_number;
    $table["action"] = array(
      array(
        "name" => "Detail",
        "type" => "link",
        "modal_id" => "edit_civilization_",
        "button_color" => "primary",
        "url" => site_url($_page . "detail/"),
        "param" => "id",
      ),
    );
    return $table;
  }
  public function validation_config()
  {
    $config = array(
      array(
        'field' => 'no_kk',
        'label' => 'no_kk',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'chief_name',
        'label' => 'chief_name',
        'rules' =>  'trim|required',
      ),
      array(
        'field' => 'member_count',
        'label' => 'member_count',
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
  public function get_form_data($village_id = NULL, $id = NULL)
  {
    if (isset($id)) {
      $this->load->model(array(
        'civilization_model',
      ));
      $civilization = $this->civilization_model->civilization($id)->row();

      $this->id             = $civilization->id;
      $village_id             = $civilization->village_id;
      $this->no_kk          = $civilization->no_kk;
      $this->chief_name     = $civilization->chief_name;
      $this->member_count   = $civilization->member_count;
      $this->income         = $civilization->income;
      $this->job            = $civilization->job;
      $this->age            = $civilization->age;
      $this->study          = $civilization->study;

      $this->file_scan      = $civilization->file_scan;
      $this->_file_scan     = $civilization->_file_scan;

      $this->civilization_card_scan      = $civilization->civilization_card_scan;
      $this->_civilization_card_scan     = $civilization->_civilization_card_scan;
      
    }

    $_data["form_data"] = array(
      "id" => array(
        'type' => 'hidden',
        'label' => "ID",
        'value' => $this->id
      ),
      "village_id" => array(
        'type' => 'hidden',
        'label' => "village_id",
        "value" => $village_id
      ),
      "no_kk" => array(
        'type' => 'text',
        'label' => "Nomor KK",
        'value' => $this->no_kk
      ),
      "chief_name" => array(
        'type' => 'text',
        'label' => "Kepala Keluarga",
        'value' => $this->chief_name
      ),
      "member_count" => array(
        'type' => 'number',
        'label' => "Jumlah Anggota Keluarga",
        'value' => $this->member_count
      ),
      "age" => array(
        'type' => 'text',
        'label' => "Umur",
        'value' => $this->age
      ),
      "study" => array(
        'type' => 'text',
        'label' => "Pendidikan Terakhir",
        'value' => $this->study
      ),
      "job" => array(
        'type' => 'text',
        'label' => "Pekerjaan",
        'value' => $this->job
      ),
      "income" => array(
        'type' => 'number',
        'label' => "Pendapatan / Bulan",
        'value' => $this->income
      ),
      "file_scan" => array(
        'type' => 'file',
        'label' => "File Scan KK ( JPG atau PNG )",
        'value' => $this->file_scan
      ),
      "_file_scan" => array(
        'type' => 'hidden',
        'label' => "File Scan KK ( JPG atau PNG )",
        'value' => $this->_file_scan
      ),
      #######################
      "civilization_card_scan" => array(
        'type' => 'file',
        'label' => "File Scan KTP ( JPG atau PNG )",
        'value' => $this->civilization_card_scan
      ),
      "_civilization_card_scan" => array(
        'type' => 'hidden',
        'label' => "File Scan KTP ( JPG atau PNG )",
        'value' => $this->_civilization_card_scan
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
  public function get_form_data_readonly($civilization_id = NULL)
  {
    if (isset($civilization_id)) {
      $this->load->model(array(
        'village_model',
      ));
      $civilization = $this->civilization_model->civilization($civilization_id)->row();
      $village = $this->village_model->village($civilization->village_id)->row();

      $this->id             = $civilization->id;
      $village_id             = $civilization->village_id;
      $this->no_kk          = $civilization->no_kk;
      $this->chief_name     = $civilization->chief_name;
      $this->member_count   = $civilization->member_count;
      $this->income         = $civilization->income;
      $this->job            = $civilization->job;
      $this->age            = $civilization->age;
      $this->study          = $civilization->study;

      $this->file_scan      = $civilization->file_scan;
      $this->_file_scan     = $civilization->_file_scan;

      $this->civilization_card_scan      = $civilization->civilization_card_scan;
      $this->_civilization_card_scan     = $civilization->_civilization_card_scan;
    }

    $_data["form_data"] = array(
      // "name" => array(
      //   'type' => 'text',
      //   'readonly' => 'readonly',
      //   'label' => "Nama Desa",
      //   'value' => $village->name,
      // ),
      "no_kk" => array(
        'type' => 'text',
        'readonly' => 'readonly',
        'label' => "Nomor KK",
        'value' => $this->no_kk,
      ),
      "chief_name" => array(
        'type' => 'text',
        'readonly' => 'readonly',
        'label' => "Kepala Keluarga",
        'value' => $this->chief_name,
      ),
      "member_count" => array(
        'type' => 'number',
        'readonly' => 'readonly',
        'label' => "Jumlah Anggota Keluarga",
        'value' => $this->member_count,
      ),
      "age" => array(
        'type' => 'text',
        'label' => "Umur",
        'readonly' => 'readonly',
        'value' => $this->age
      ),
      "study" => array(
        'type' => 'text',
        'readonly' => 'readonly',
        'label' => "Pendidikan Terakhir",
        'value' => $this->study
      ),
      "job" => array(
        'type' => 'text',
        'readonly' => 'readonly',
        'label' => "Pekerjaan",
        'value' => $this->job
      ),
      "income" => array(
        'type' => 'number',
        'readonly' => 'readonly',
        'label' => "Pendapatan / Bulan",
        'value' => $this->income
      ),
      // "file_scan" => array(
      //   'type' => 'file',
      //   'label' => "File Scan KK ( JPG atau PNG )",
      // ),
      "_file_scan" => array(
        'type' => 'hidden',
        'label' => "File Scan KK ( JPG atau PNG )",
        'value' => $this->_file_scan
      ),
      "_civilization_card_scan" => array(
        'type' => 'hidden',
        'label' => "File Scan KTP ( JPG atau PNG )",
        'value' => $this->_civilization_card_scan
      ),
    );
    return $_data;
  }
}
