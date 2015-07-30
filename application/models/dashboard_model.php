<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
     public function view_count(){
       $query=$this->db->select('team,count(*)')->from('candidates')->group_by('team')->get();
       return $query->result_array();
     }
}?>
