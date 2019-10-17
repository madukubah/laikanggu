<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aid_model extends MY_Model
{
  protected $table = "aid";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'aid_id' );
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
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create_batch($data_batch)
  {
    $this->db->trans_begin();

    $this->db->insert_batch($this->table, $data_batch);
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
      $this->set_error("gagal");//('aid_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");//('aid_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");//('aid_delete_successful');
    return TRUE;
  }

    /**
   * aid
   *
   * @param int|array|null $id = id_aids
   * @return static
   * @author madukubah
   */
  public function aid( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->aids(  );

      return $this;
  }

   /**
   * aid
   *
   * @param int|array|null $id = id_aids
   * @return static
   * @author madukubah
   */
  public function aid_by_user_id( $user_id = NULL  )
  {
      if( isset($user_id) )
      {
        $this->where($this->table.'.user_id', $user_id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->aids(  );

      return $this;
  }

  /**
   * aid
   *
   * @param int|array|null $id = id_aids
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
   * aids
   *
   *
   * @return static
   * @author madukubah
   */
  public function aids_by_year( $start = 0 , $limit = NULL, $year )
  {
    
    $this->where($this->table.'.year', $year);
      
      return $this->aids( $start, $limit  );
  }

   /**
   * aids
   *
   *
   * @return static
   * @author madukubah
   */
  public function aids_by_date( $start = 0 , $limit = NULL, $date )
  {
    
    $this->where($this->table.'.date', $date);
      
      return $this->aids( $start, $limit  );
  }

  /**
   * aids
   *
   *
   * @return static
   * @author madukubah
   */
  public function aids( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }

      $this->select( $this->table.'.*' );
      $this->select( $this->table.'.date as _date' );
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
      $this->order_by($this->table.'.date', 'date');
      return $this->fetch_data();
  }

  /**
   * aids
   *
   *
   * @return static
   * @author madukubah
   */
  public function get_years(  )
  {

      $this->db->select( "CONCAT( ".$this->table.".year ,  ' ' ) as _year"  );
      $this->db->select( $this->table.'.year' );
      
      $this->db->group_by($this->table.'.year');
      $this->db->order_by( $this->table.'.id', 'asc');

      return $this->db->get( $this->table );
  }

  /**
   * aids
   *
   *
   * @return static
   * @author madukubah
   */
  public function get_dates( $year )
  {

      // $this->db->select( "CONCAT( ".$this->table.".year ,  ' ' ) as _year"  );
      $this->db->select( $this->table.'.date as _date' );
      
      $this->db->where($this->table.'.year', $year );

      $this->db->group_by($this->table.'.date');
      $this->db->order_by( $this->table.'.date', 'asc');

      return $this->db->get( $this->table );
  }

}
?>
