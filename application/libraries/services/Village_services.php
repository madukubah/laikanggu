<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Village_services
{

  protected $id;
  protected $name;
  protected $description;
  protected $polygon;
  protected $kk_count;
  protected $house_count;
  function __construct()
  {
    $this->id           = '';
    $this->name         = '';
    $this->description  = "";
    $this->polygon      = "";
    $this->kk_count     = 0;
    $this->house_count  = 0;
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }

  public function get_table_config($_page, $start_number = 1)
  {
    $table["header"] = array(
      'name' => 'Nama Desa',
      'description' => 'Deskripsi',
      'kk_count' => 'Jumlah KK',
      'house_count' => 'Jumlah Rumah',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
      array(
        "name" => "Edit",
        "type" => "link",
        "url" => site_url($_page . "edit/"),
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
          "user_id" => array(
            'type' => 'hidden',
            'label' => "user_id",
          ),
        ),
        "title" => "Group",
        "data_name" => "name",
      ),
    );
    return $table;
  }

  public function get_table_config_civilization($_page, $start_number = 1)
  {
    $table["header"] = array(
      'name' => 'Nama Desa',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
      array(
        "name" => "Daftar Kartu Keluarga",
        "type" => "link",
        "url" => site_url($_page . "village/"),
        "button_color" => "primary",
        "param" => "id",
      ),
    );
    return $table;
  }

  public function get_table_config_aid($_page, $start_number = 1)
  {
    $table["header"] = array(
      'name' => 'Nama Desa',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
      array(
        "name" => "Detail",
        "type" => "link",
        "url" => site_url($_page . "village/"),
        "button_color" => "primary",
        "param" => "id",
      ),
    );
    return $table;
  }

  public function validation_config()
  {
    $config = array(
      array(
        'field' => 'name',
        'label' => 'name',
        'rules' =>  'trim|required',
      ),
      // array(
      //   'field' => 'description',
      //   'label' => 'description',
      //   'rules' =>  'trim|required',
      // ),
    );

    return $config;
  }

  public function get_table_config_housing($_page, $start_number = 1)
  {
    $table["header"] = array(
      'name' => 'Nama Desa',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
      array(
        "name" => "Lihat Data",
        "type" => "link",
        "url" => site_url($_page . "village/"),
        "button_color" => "primary",
        "param" => "id",
        
      ),
    );
    return $table;
  }

  /**
   * get_form_data
   *
   * @return array
   * @author madukubah
   **/
  public function get_form_data($village_id = NULL)
  {
    if (isset($village_id)) {
      $this->load->model(array(
        'village_model',
      ));
      $village         = $this->village_model->village($village_id)->row();

      $this->id             = $village->id;
      $this->name           = $village->name;
      $this->description    = $village->description;
      $this->polygon        = $village->polygon;
      $this->kk_count       = $village->kk_count;
      $this->house_count    = $village->house_count;
    }

    $_data["form_data"] = array(
      "id" => array(
        'type' => 'hidden',
        'label' => "ID",
        'value' => $this->form_validation->set_value('id', $this->id),
      ),
      "name" => array(
        'type' => 'text',
        'label' => "Nama Desa",
        'value' => $this->form_validation->set_value('name', $this->name),
      ),
      "kk_count" => array(
        'type' => 'number',
        'label' => "Jumlah KK",
        'value' => $this->form_validation->set_value('kk_count', $this->kk_count),
      ),
      "house_count" => array(
        'type' => 'number',
        'label' => "Jumlah Rumah",
        'value' => $this->form_validation->set_value('house_count', $this->house_count),
      ),
      "description" => array(
        'type' => 'textarea',
        'label' => "Ringkasan Desa",
        'value' => $this->form_validation->set_value('description', $this->description),
      ),
     
      "polygon" => array(
        'type' => 'hidden',
        'label' => "Polygon",
        'value' => $this->form_validation->set_value('polygon', $this->polygon),
      ),
    );
    return $_data;
  }
}
