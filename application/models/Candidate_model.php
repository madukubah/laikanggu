<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate_model extends MY_Model
{
  protected $table = "candidate";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'candidate_id' );
  }

  /**
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create( $data )
  {
      // Filter the data passed
      $data = $this->_filter_data($this->table, $data);

      $this->db->insert($this->table, $data);
      $id = $this->db->insert_id($this->table . '_id_seq');
    
      if( isset($id) )
      {
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
  public function update( $data, $data_param  )
  {
    $this->db->trans_begin();
    $data = $this->_filter_data($this->table, $data);

    $this->db->update($this->table, $data, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
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
  public function delete( $data_param  )
  {
    //foreign
    //delete_foreign( $data_param. $models[]  )
    if( !$this->delete_foreign( $data_param ) )
    {
      $this->set_error("gagal");//('candidate_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");//('candidate_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");//('candidate_delete_successful');
    return TRUE;
  }

    /**
   * candidate
   *
   * @param int|array|null $id = id_candidates
   * @return static
   * @author madukubah
   */
  public function candidate( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->candidates(  );

      return $this;
  }

   /**
   * candidate
   *
   * @param int|array|null $id = id_candidates
   * @return static
   * @author madukubah
   */
  public function candidate_by_user_id( $user_id = NULL  )
  {
      if( isset($user_id) )
      {
        $this->where($this->table.'.user_id', $user_id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->candidates(  );

      return $this;
  }

  /**
   * candidate
   *
   * @param int|array|null $id = id_candidates
   * @return static
   * @author madukubah
   */
  public function is_exist_by_civilization_id( $civilization_id = NULL  )
  {
      if( isset($civilization_id) )
      {
        $this->where($this->table.'.civilization_id', $civilization_id);
      }
      return $this->record_count() != 0 ;
  }

  /**
   * candidates
   *
   *
   * @return static
   * @author madukubah
   */
  public function candidates( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }

      $this->select( $this->table.'.*' );
      $this->select( "civilization.chief_name as chief_name" );
      $this->select( "CONCAT( civilization.no_kk, ' ' )  as no_kk" );
      $this->select( "village.name as village_name" );

      $this->join( 
        "civilization" ,
        "civilization.id = " .$this->table.'.civilization_id',
        "inner"
      );
      $this->join( 
        "village" ,
        "village.id = civilization.village_id ",
        "inner"
      );


      $this->offset( $start );
      $this->order_by($this->table.'.id', 'asc');
      return $this->fetch_data();
  }

}
?>
