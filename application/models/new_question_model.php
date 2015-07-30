<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_Question_Model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
     public function save_qa($qadata){
       $this->db->insert('question_new', $qadata);
       return;
     }
}?>
