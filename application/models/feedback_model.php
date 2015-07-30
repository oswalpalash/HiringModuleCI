<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feedback_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
    public function generate_feedback($cand_id){
       $this->db->select('team');
       $this->db->from('candidates');
       $this->db->where('id',$cand_id);
       $query = $this->db->get();
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result_array();
           $team= $row[0]['team'];
       }
       //we know the team now
       //we find questions for that team
       $this->db->select('*');
       $this->db->from('question');
       $this->db->where('team',$team);
       $query= $this->db->get();
       $questions = $query->result_array();
       //now we have questions for the user's team

       return $questions;
     }
     function get_interview_ids($cand_id)
     {
          // return "lmao";
          $this->db->select('id');
          $this->db->from('interview');
          $this->db->where('cand_id',$cand_id);
          $query = $this->db->get();
          if ( $query->num_rows() > 0 )
          {
              $row = $query->result_array();
              return $row;
          }
     }
     function get_interviews($cand_id)
     {
          // return "lmao";
          $this->db->select('*');
          $this->db->from('interview');
          $this->db->where('cand_id',$cand_id);
          $query = $this->db->get();
          if ( $query->num_rows() > 0 )
          {
              $row = $query->result_array();
              return $row;
          }
     }
     public function save_feedback($intw_id,$q_id,$data)
     {
          //check if feedback exists
          $this->db->select('*');
          $this->db->from('feedback');
          $where = array('intw_id'=>$intw_id,'ques_id'=>$q_id);
          $this->db->where($where);
          $res = $this->db->get();
          if ($res->num_rows()>0){
            //delete the values
            $this->db->query('DELETE FROM feedback WHERE `intw_id` = '.$intw_id.' and `ques_id`= '.$q_id.';');
          }
          $this->db->insert('feedback', $data);
          return;
     }
     public function update_intw($intw_id,$decision,$another_round)
     {
          $this->db->query('update interview
          SET decision = '.$decision .',another_round='.$another_round.'
          where id = '.$intw_id.';');
     }
}?>
