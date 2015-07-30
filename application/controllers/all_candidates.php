<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class all_candidates extends CI_Controller {

	public function index()
	{
		$this->load->library('pagination');
		$config = array();
		$this->load->model('candidate_model');
		$config["base_url"] = base_url() . "index.php/pagination_controller/contact_info";
		$total_row = $this->candidate_model->record_count();

    if(!empty($this->session->userdata('username')))
    {
      $d['v'] = 'list_candidates';
      $d['data'] = $this->candidate_model->get_all();
      $this->load->view('template', $d);
			// log_message('debug',var_dump($sess_id));
    }
    else{
      redirect('login');

    }
	}
	public function team($teamname)
	{
		if(!empty($this->session->userdata('username')))
    {
			$this->load->model('candidate_model');
      $d['v'] = 'list_candidates';
      $d['data'] = $this->candidate_model->get_teamwise_all($teamname);
      $this->load->view('template', $d);
    }
    else{
      redirect('login');

    }
	}
}
