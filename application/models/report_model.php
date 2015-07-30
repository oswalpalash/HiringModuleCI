<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
    public function generate_report($cand_id){
       $query = $this->db->query('select * from
       (select * from interview where cand_id = '.$cand_id.') T1,
       (select * from feedback where cand_id = '. $cand_id.') T2,
       (select * from question) T3
       where T1.id = T2.intw_id and T2.ques_id=T3.id
       order by timestamp desc;
');
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
}?>
