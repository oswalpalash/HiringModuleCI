<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

	public function save()
	{
		if(!empty($this->session->userdata('username')))
    {
			// var_dump($this->input->post());
			// die();
			if ($this->input->post('submit') == "Submit")
			{
				$this->load->model('Question_Model');
				$ques_text = $this->input->post('ques');
				$teamname = $this->input->post('team');
				$db_data = array(
					'QuestionText'=>$ques_text,
					'team'=>$teamname
				);
				$this->Question_Model->add_question($db_data);
				redirect('home');
			}
		}
	}
	public function add()
	{
		if(!empty($this->session->userdata('username')))
		{
			$this->load->model('candidate_model');
			$d['v'] = 'add_question';
			$d['data'] = $this->candidate_model->get_teams();
			$this->load->view('template', $d);
		}
		else{
			redirect('home');

		}
	}
}
