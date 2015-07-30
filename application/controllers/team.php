<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

	public function save()
	{
		if(!empty($this->session->userdata('username')))
    {
			// var_dump($this->input->post());
			// die();
			if ($this->input->post('submit') == "Submit")
			{
				$this->load->model('Team_Model');
				$teamname = $this->input->post('teamname');
				$db_data = array(
					'groupname'=>$teamname
				);
				$this->Team_Model->add_team($db_data);
				redirect('all');
			}
		}
	}
	public function add()
	{
		if(!empty($this->session->userdata('username')))
		{
			$d['v'] = 'add_team';
			$d['data'] = '';
			$this->load->view('template', $d);
		}
		else{
			redirect('all');

		}
	}
}
