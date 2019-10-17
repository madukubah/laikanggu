<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Housing_model extends MY_Model
{
  protected $table = "house";

  function __construct()
  {
    parent::__construct($this->table);
    parent::set_join_key('house_id');
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
      $this->set_error("gagal"); //('house_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param);
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();

      $this->set_error("gagal"); //('house_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil"); //('house_delete_successful');
    return TRUE;
  }

  /**
   * house
   *
   * @param int|array|null $id = id_houses
   * @return static
   * @author madukubah
   */
  public function house($id = NULL)
  {
    if (isset($id)) {
      $this->where($this->table . '.id', $id);
    }

    $this->limit(1);
    $this->order_by($this->table . '.id', 'desc');

    $this->houses();

    return $this;
  }

  /**
   * house
   *
   * @param int|array|null $id = id_houses
   * @return static
   * @author madukubah
   */
  public function houses_civilization_id($civilization_id = NULL)
  {
    if (isset($civilization_id)) {
      $this->where($this->table . '.civilization_id', $civilization_id);
    }

    $this->houses();

    return $this;
  }

   /**
   * house
   *
   * @param int|array|null $id = id_houses
   * @return static
   * @author madukubah
   */
  public function count_houses_by_category($category = NULL)
  {
    if (isset($category)) {
      $this->where($this->table . '.category', $category);
    }

    // $this->houses();

    return $this->record_count();
  }
  /**
   * houses
   *
   *
   * @return static
   * @author madukubah
   */
  public function houses($start = 0, $limit = NULL, $village_id = NULL)
  {
    $this->select($this->table . ".*");
    $this->select("CONCAT( 'RT ',  " . $this->table . ".rt , ' Dusun ',  " . $this->table . ".dusun ) as address ");
    $this->select("CONCAT( '" . base_url("uploads/house/") . "', " . $this->table . ".file_scan  ) as url_file_scan ");
    $this->select("civilization.chief_name as chief_name");
    $this->select("civilization.village_id as village_id");
    $this->select("CONCAT( civilization.no_kk, ' ' ) as no_kk");

    $this->join(
      "civilization",
      "civilization.id = " . $this->table . ".civilization_id",
      "inner"
    );
    if (isset($village_id)) {
      $this->where('civilization.village_id', $village_id);
    }
    if (isset($limit)) {
      $this->limit($limit);
    }
    $this->offset($start);
    $this->order_by($this->table . '.civilization_id', 'asc');
    return $this->fetch_data();
  }

  /**
   * houses
   *
   *
   * @return static
   * @author madukubah
   */
  public function record_count_by_village_id($village_id)
  {
    $this->join(
      "civilization",
      "civilization.id = " . $this->table . ".civilization_id",
      "inner"
    );
    if (isset($village_id)) {
      $this->where('civilization.village_id', $village_id);
    }
    return $this->record_count();
  }

  /**
   * houses
   *
   *
   * @return static
   * @author madukubah
   */
  public function get_civilization_id_list($village_id = NULL)
  {
    $this->select($this->table . '.civilization_id');
    $this->join(
      "civilization",
      "civilization.id = " . $this->table . ".civilization_id",
      "inner"
    );
    if (isset($village_id)) {
      $this->where('civilization.village_id', $village_id);
    }
    return $this->fetch_data();
  }
}
