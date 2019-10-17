<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Candidate_services
{

  function __construct()
  { }

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
  public function get_table_accumulation($_page, $start_number = 1, $village_id = "")
  {
    $table["header"] = array(
      'name' => 'Kategori',
      'count' => 'Jumlah',
    );
    $table["number"] = $start_number;
      $table["action"] = array(
      array(
        "name" => "Lihat",
        "type" => "link",
        "modal_id" => "edit_civilization_",
        "button_color" => "primary",
        "url" => site_url($_page . "code/"),
        "param" => "code",
        "get" => "?village_id=" . $village_id,
      ),
    );
    return $table;
  }

  public function get_table_config($_page, $start_number = 1)
  {
    $table["header"] = array(
      'no_kk' => 'No KK',
      'village_name' => 'Desa',
      'chief_name' => 'Nama Kepala Keluarga',
      'type_of_aid' => 'Jenis Bantuan',
    );
    $table["number"] = $start_number;
    $table["action"] = array(
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
  public function get_form_data($village_id = NULL)
  {

    $_data["form_data"] = array(
      "id" => array(
        'type' => 'hidden',
        'label' => "ID",
      ),
      "village_id" => array(
        'type' => 'hidden',
        'label' => "village_id",
        "value" => $village_id
      ),
      "no_kk" => array(
        'type' => 'text',
        'label' => "Nomor KK",
      ),
      "chief_name" => array(
        'type' => 'text',
        'label' => "Kepala Keluarga",
      ),
      "member_count" => array(
        'type' => 'number',
        'label' => "Jumlah Anggota Keluarga",
      ),
      "file_scan" => array(
        'type' => 'file',
        'label' => "File Scan KK ( JPG atau PNG )",
      ),
      "_file_scan" => array(
        'type' => 'hidden',
        'label' => "File Scan KK ( JPG atau PNG )",
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
  public function type_of_aid()
  {
    $aid_select = array(
      "UBIN/TEGEL"=> "UBIN/TEGEL",
      "EMBUATAN TEMBOK" => "EMBUATAN TEMBOK",
      "PEMBELIAN SENG" => "PEMBELIAN SENG",
      "PENGADAAN LISTRIK" => "PENGADAAN LISTRIK",
      "PENGADAAN SUMUR" => "PENGADAAN SUMUR",
    );
    $_data["form_data"] = array(
      "type_of_aid[]" => array(
        'type' => 'select',
        'label' => "Bantuan Yang Akan Di Berikan",
        "options" => $aid_select
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
  public function get_header_form()
  {
    $year_select = array(
      2019 => "2019",
      2020 => "2020",
      2021 => "2021",
    );
    $_data["form_data"] = array(
      "year" => array(
        'type' => 'select',
        'label' => "Tahun Anggaran",
        "options" => $year_select
      ),
      "date" => array(
        'type' => 'date',
        'label' => "Tanggal",
        'value' => date("m/d/Y"),
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
  public function extract_civilization_id($data)
  {
    $data_arr = array();
    foreach ($data as $item) {
      $data_arr[] = $item->civilization_id;
    }

    return $data_arr;
  }
}
