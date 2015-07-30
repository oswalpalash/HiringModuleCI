<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_User extends CI_Controller {

	public function save()
	{
		if(!empty($this->session->userdata('username')))
    {
			// var_dump($this->input->post());
			// die();
			if ($this->input->post('submit') == "Submit")
			{
				$this->load->model('User_Model');
				$db_data = array(
					'username'=>$this->input->post('username'),
					'email'=>$this->input->post('email'),
					'password'=>$this->input->post('password'),
					'team'=>$this->input->post('team'),
				);
				// var_dump($db_data);
				// die();
				$this->User_Model->add_user($db_data);
				redirect('home');
			}
		}
	}
	public function index()
	{
		if(!empty($this->session->userdata('username')))
		{
			$d['v'] = 'add_user';
			$this->load->model('candidate_model');
			$d['data'] = $this->candidate_model->get_teams();
			$this->load->view('template', $d);
		}
		else{
			redirect('all');

		}
	}
}
