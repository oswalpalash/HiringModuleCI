<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class add_candidate extends CI_Controller {
	public function index()
	{
		if(!empty($this->session->userdata('username')))
    {
      $d['v'] = 'add_candidate';
      $this->load->model('candidate_model');
			$d['data'] = $this->candidate_model->get_teams();
      $this->load->view('template', $d);
    }
    else{
      redirect('../');

    }
	}
	public function upload()
	{

		$this->load->model('candidate_model');
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|txt|pdf|docx';
		$config['max_size']    = '100000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('resume'))
		{
			#uploading failed
			echo $this->upload->display_errors();
			// redirect ('/whatiswrong?');
		}
		// log_message('debug', var_export($this->input->post()));
		$data = array('name'=>$this->input->post('name'),
		'resume' => $this->upload->data()['full_path'],
		'team'=> $this->input->post('team'),
		'email'=>$this->input->post('email'),
		'comments'=>$this->input->post('comments')
		);
		$this->candidate_model->add_candid($data);
		redirect('all');
	}
}
