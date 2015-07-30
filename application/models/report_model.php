<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
    public function generate_fq($intw_id){
       $query = $this->db->query('select * from feedback_new,question_new
       where feedback_new.intw_id=question_new.intw_id and
        feedback_new.intw_id = '.$intw_id.';');
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result();
           return $row;
       }
     }
     public function find_name($cand_id){
       $query = $this->db->select('name')->from('candidates')->where('id',$cand_id)->get();
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result_array();
           return $row[0]['name'];
       }
     }
     public function list_intw_ids($cand_id){
       $query = $this->db->select('*')->from('interview')->where('cand_id',$cand_id)->get();
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result_array();
           return $row;
       }
     }
     public function show_feedbk($intw_id){
       $query = $this->db->select('*')->from('feedback_new')->where('intw_id',$intw_id)->get();
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result_array();
           return $row;
       }
     }
     public function show_qa($intw_id){
       $query = $this->db->select('*')->from('question_new')->where('intw_id',$intw_id)->get();
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result_array();
           return $row;
       }
     }
}?>
