<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class new_feedback_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
     }
     public function save_feedback($qadata)
     {
          $this->db->insert('feedback_new', $qadata);
          return;
     }
}?>
