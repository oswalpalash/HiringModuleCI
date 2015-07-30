<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
     }

     public function index()
     {
        $array_items = array('username' => '', 'loginuser' => '');
        $this->session->unset_userdata($array_items);
        $this->session->userdata = array();
        $this->session->sess_destroy();
        redirect('login');
     }

}?>
