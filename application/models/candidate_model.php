<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class candidate_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }


    public function add_candid($data)
    {
         $this->db->insert('candidates', $data);
         return;
    }
     function get_all()
     {
          $query = $this->db->query(' select * from
          (select * from interview order by timestamp desc) as T1
          inner join
          (select max(timestamp) as timestamp,cand_id from interview group by cand_id) as T2
          on T1.timestamp = T2.timestamp
          right join
          (select * from candidates) as T3
          on T3.id=T2.cand_id
          ;');
          if ( $query->num_rows() > 0 )
          {
              $row = $query->result();
              return $row;
          }

     }
     function get_teamwise_all($teamname)
     {
       $query = $this->db->query(' select * from
       (select * from interview order by timestamp desc) as T1
       inner join
       (select max(timestamp) as timestamp,cand_id from interview group by cand_id) as T2
       on T1.timestamp = T2.timestamp
       right join
       (select * from candidates where team="'.$teamname.'") as T3
       on T3.id=T2.cand_id
       ;');
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result();
           return $row;
       }
     }
     function get_teams()
     {
          $config = array();

          $this->db->select('*');
          $this->db->from('groups');
          // $this->db->limit('5');
          // $this->db->where('id',5);
          $query = $this->db->get();
          if ( $query->num_rows() > 0 )
          {
              $row = $query->result_array();
              return $row;
          }
     }
     function get_profile($cand_id)
     {
          // return "lmao";
          $query = $this->db->select('*')->from('candidates')->where('id',$cand_id)->get();
          if ( $query->num_rows() > 0 )
          {
              $row = $query->result_array();
              return $row;
          }
     }
     function get_email($cand_id)
     {
          $query = $this->db->select('email')->from('candidates')->where('id',$cand_id)->get();
          if ( $query->num_rows() > 0 )
          {
              $row = $query->result_array();
              return $row;
          }
     }

     function record_count()
     {
       $this->db->select('*');
       $this->db->from('candidates');
       $query = $this->db->get();
       return $query->num_rows();
     }
     public function reject($cand_id)
     {
          $this->db->where('id', $cand_id)->update('candidates',array('status'=>2));
          // Find the most recent interview
          return;
     }
     public function set_status($cand_id,$status)
     {
          $this->db->where('id', $cand_id)->update('candidates',array('status'=>$status));
          // Find the most recent interview
          return;
     }
}?>
