<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{

    if(!empty($this->session->userdata('username')))
    {
      $this->load->model('Dashboard_Model');
      $d['v'] = 'home';
      $d['data'] = $this->Dashboard_Model->view_count();
      $this->load->view('template', $d);
    }
    else{
      redirect('login');

    }
	}
}
