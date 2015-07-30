<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
     public function add_team($teamdata){
       $this->db->insert('groups', $teamdata);
       return;
     }
}?>
