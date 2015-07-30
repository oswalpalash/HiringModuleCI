<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }

     function get_user($usr, $pwd)
     {
          $arrayName = array('username' => $usr,'password'=>$pwd );
          $query = $this->db->select('*')->from('users')->where($arrayName)->get();
          return $query->num_rows();

     }
     public function get_email($username){
       $this->db->select('*');
       $this->db->from('users');
       $this->db->where('username',$username);
       $query = $this->db->get();
       if ( $query->num_rows() > 0 )
       {
           $row = $query->result_array();
           return $row;
       }
     }
}?>
