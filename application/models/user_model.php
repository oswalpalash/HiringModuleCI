<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
     public function add_user($userdata){
       $this->db->insert('users', $userdata);
       return;
     }
}?>
