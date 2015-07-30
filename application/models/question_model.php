<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question_Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
     public function add_question($teamdata){
       $this->db->insert('question', $teamdata);
       return;
     }
}?>
