<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class interview_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }


    public function create_interview($data)
    {
        ##SEND AN EMAIL TRIGGER
         $this->db->insert('interview', $data);
         return;
    }
    public function get_interviewers($team)
    {

      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('team',$team);
      $query = $this->db->get();
      if ( $query->num_rows() > 0 )
      {
          $row = $query->result_array();
          return $row;
      }
    }
    public function get_interviews($cid)
    {
      $this->db->select('*');
      $this->db->from('interview');
      $this->db->where('cand_id',$cid);
      $query = $this->db->get();
      if ( $query->num_rows() > 0 )
      {
          $row = $query->result_array();
          return $row;
      }
    }
}?>
