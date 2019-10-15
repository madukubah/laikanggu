<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Civilization_model extends MY_Model
{
  protected $table = "civilization";

  function __construct()
  {
    parent::__construct($this->table);
    parent::set_join_key('civilization_id');
  }

  /**
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create($data)
  {
    // Filter the data passed
    $data = $this->_filter_data($this->table, $data);

    $this->db->insert($this->table, $data);
    $id = $this->db->insert_id($this->table . '_id_seq');

    if (isset($id)) {
      $this->set_message("berhasil");
      return $id;
    }
    $this->set_error("gagal");
    return FALSE;
  }
  /**
   * update
   *
   * @param array  $data
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function update($data, $data_param)
  {
    $this->db->trans_begin();
    $data = $this->_filter_data($this->table, $data);

    $this->db->update($this->table, $data, $data_param);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();

      $this->set_error("gagal");
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");
    return TRUE;
  }
  /**
   * delete
   *
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function delete($data_param)
  {
    //foreign
    //delete_foreign( $data_param. $models[]  )
    if (!$this->delete_foreign($data_param)) {
      $this->set_error("gagal"); //('civilization_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();

      $this->set_error("gagal"); //('civilization_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil"); //('civilization_delete_successful');
    return TRUE;
  }

  /**
   * civilization
   *
   * @param int|array|null $id = id_civilizations
   * @return static
   * @author madukubah
   */
  public function civilization($id = NULL)
  {
    if (isset($id)) {
      $this->where($this->table . '.id', $id);
    }

    $this->limit(1);
    $this->order_by($this->table . '.id', 'desc');

    $this->civilizations();

    return $this;
  }

  /**
   * civilization
   *
   * @param int|array|null $id = id_civilizations
   * @return static
   * @author madukubah
   */
  public function civilization_by_no_kk_and_village_id($no_kk = NULL, $village_id = NULL)
  {
    if (isset($no_kk)) {
      $this->like(
        $this->table . '.no_kk',
        $no_kk
      );
    }
    $this->where($this->table . '.village_id', $village_id);
    $this->limit(1);
    $this->order_by($this->table . '.id', 'desc');

    $this->civilizations();

    return $this;
  }

  /**
   * civilizations
   *
   *
   * @return static
   * @author madukubah
   */
  public function civilizations($start = 0, $limit = NULL, $village_id = NULL)
  {
    if (isset($village_id)) {
      $this->where($this->table . '.village_id', $village_id);
    }
    if (isset($limit)) {
      $this->limit($limit);
    }

    $this->select($this->table . '.*');
    $this->select(" " . $this->table . ".file_scan  as images");
    $this->select(" " . $this->table . ".file_scan  as _file_scan");
    $this->select(" CONCAT( " . $this->table . ".no_kk, ' ' )  as no_kk");

    $this->offset($start);
    $this->order_by($this->table . '.id', 'asc');
    return $this->fetch_data();
  }

  /**
   * civilizations
   *
   *
   * @return static
   * @author madukubah
   */
  public function civilizations_by_list_id($start = 0, $limit = NULL, $list_ids = [], $village_id = NULL)
  {
    // if (empty($list_ids)) return $list_ids;
    $this->db->select($this->table . '.*');
    $this->db->select(" " . $this->table . ".file_scan  as images");
    $this->db->select(" " . $this->table . ".file_scan  as _file_scan");
    $this->db->select(" CONCAT( " . $this->table . ".no_kk, ' ' )  as no_kk");

    if (!empty($list_ids)) {
      $this->db->where_in($this->table . ".id", $list_ids);
    }

    if (isset($village_id)) {
      $this->db->where($this->table . '.village_id', $village_id);
    }
    return $this->db->get($this->table);
  }

  /**
   * civilizations
   *
   *
   * @return static
   * @author madukubah
   */
  public function not_in_civilizations_by_list_id($start = 0, $limit = NULL, $list_ids = [], $village_id = NULL)
  {
    $this->db->select($this->table . '.*');
    $this->db->select(" " . $this->table . ".file_scan  as images");
    $this->db->select(" " . $this->table . ".file_scan  as _file_scan");
    $this->db->select(" CONCAT( " . $this->table . ".no_kk, ' ' )  as no_kk");

    if (!empty($list_ids)) {
      $this->db->where_not_in($this->table . ".id", $list_ids);
    }

    if (isset($village_id)) {
      $this->db->where($this->table . '.village_id', $village_id);
    }

    return $this->db->get($this->table);
  }

  /**
   * civilizations
   *
   *
   * @return static
   * @author madukubah
   */
  public function record_count_by_village_id($village_id)
  {
    $this->select($this->table . '.*');

    $this->where($this->table . '.village_id', $village_id);
    return $this->record_count();
  }
}
