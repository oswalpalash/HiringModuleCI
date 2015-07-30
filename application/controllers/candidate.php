<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class candidate extends CI_Controller {
	public function view($url_id)
	{
		if(!empty($this->session->userdata('username')))
    {
      $d['v'] = 'view_profile';
			$this->load->model('candidate_model');
			$this->load->model('interview_model');
      $d['data']=$this->candidate_model->get_profile($url_id);
			$d['interviews']=$this->interview_model->get_interviews($url_id);
      $this->load->view('template', $d);
    }
    else{
      redirect('../');

    }
	}
	public function schedule($url_id,$team)
	{

		date_default_timezone_set('Asia/Calcutta');
		$this->load->model('interview_model');
		$this->load->model('candidate_model');
		$this->load->model('login_model');
		$this->load->helper('form');
		if(!empty($this->session->userdata('username')))
    {
			if ($this->input->post('submit') == "submit")
			{
				//redirect('created');
				//echo $this->input->post();
				// $test = strtotime($this->input->post('datetimepicker'));
				// $myFormatForView = date("m/d/y g:i A", $test);
				// log_message('debug', var_export($test));
				// log_message('debug', var_export($myFormatForView));
				// log_message('debug',var_export($this->input->post()));
				$intw_obj = array(
					'cand_id'=>$url_id,
					'timestamp'=>strtotime( $this->input->post('datetimepicker')),
					'interviewer'=>$this->input->post('username')
				);
				$this->interview_model->create_interview($intw_obj);
				$cand_email=$this->candidate_model->get_email($url_id)[0]['email'];
				//var_dump($cand_email);die();
				$intwr_email= $this->login_model->get_email($this->input->post('username'));
				$intwr_email = $intwr_email[0];
				#CREATING INTERVIEW OBJECT
				##TODO EMAIL TRIGGERS
				//load email helper
				$ci = get_instance();
				$ci->load->library('email');
				$config['protocol'] = "smtp";
				$config['smtp_host'] = "ssl://smtp.gmail.com";
				$config['smtp_port'] = "465";
				$config['smtp_user'] = "zomatoemail@gmail.com";
				$config['smtp_pass'] = "zomato123";
				$config['charset'] = "utf-8";
				$config['mailtype'] = "html";
				$config['newline'] = "\r\n";

				$ci->email->initialize($config);
				// EMAIL TO CANDIDATE
				$ci->email->from('zomatoemail@gmail.com', 'Hiring');
				$ci->email->to($cand_email);
				$list = array($intwr_email['email'],'fixed_email@zomato.com');
				$ci->email->bcc($list);
				$this->email->reply_to('palash.oswal@zomato.com', 'Hiring');
				$ci->email->subject('INTERVIEW SCHEDULED');
				$ci->email->message(
				"Your Interview has been Scheduled on " . $this->input->post('datetimepicker')
			);
				$this->email->send();
				redirect('/candidate/'.$url_id);

			}
      $d['v'] = 'schedule_interview';

      $d['data']= $this->interview_model->get_interviewers($team);
      $this->load->view('template', $d);
    }
    else{
      redirect('login');

    }
	}
	public function feedback($url_id)
	{
			if(!empty($this->session->userdata('username')))
			{

				$this->load->model('feedback_model');
				$d['v'] = 'feedback';
				$d['uid']= $url_id;
				$d['i_ids']=$this->feedback_model->get_interview_ids($url_id);
				$d['i_info']=$this->feedback_model->get_interviews($url_id);
	      $d['data']= $this->feedback_model->generate_feedback($url_id);
	      $this->load->view('template', $d);
			}
			else {
				redirect('login');
			}
	}
	public function feedback_new($url_id)
	{
			if(!empty($this->session->userdata('username')))
			{

				$this->load->model('feedback_model');
				$d['v'] = 'feedback_new';
				$d['uid']= $url_id;
				$d['i_ids']=$this->feedback_model->get_interview_ids($url_id);
				$d['i_info']=$this->feedback_model->get_interviews($url_id);
	      $d['data']= $this->feedback_model->generate_feedback($url_id);
	      $this->load->view('template', $d);
			}
			else {
				redirect('login');
			}
	}
	public function save_feedback_new()
	{
			$this->load->model('new_feedback_model');
			$this->load->model('feedback_model');
			$this->load->model('candidate_model');
			$this->load->model('new_question_model');
			if(!empty($this->session->userdata('username')))
			{
				//check for post data

					if ($this->input->post('submit') == "Submit")
					{
						//we have post data
						$q_count=$this->input->post('q_count');
						if(empty($this->input->post('decision'))){
							$decision=0;
						}
						else {
							$decision=1;
						}
						//TODO TRIGGER EMAIL IF DECISION FINALISED
						if(empty($this->input->post('another_round'))){
							$another_round=0;
						}
						else {
							$another_round=1;
						}
						while($q_count-->0)
						{
								$qa_obj = array(
									'cand_id'=>$this->input->post('uid'),
									'intw_id'=>$this->input->post('interview'),
									'QuestionText'=>$this->input->post('question'.$q_count),
									'AnswerText'=>$this->input->post('answer'.$q_count)
								);
								$this->new_question_model->save_qa($qa_obj);
							}
							//SAVED ALL QA
							$this->feedback_model->update_intw($this->input->post('interview'),$decision,$another_round);
							//UPDATE INTERVIEW DECISIONS
							$feedback_obj = array(
								'intw_id'=>$this->input->post('interview'),
								'cand_id'=>$this->input->post('uid'),
								'user_id'=>$this->session->userdata('username'),
								'CommentText'=>$this->input->post('comments'),
								'rating'=>$this->input->post('rating')
							);
							$this->new_feedback_model->save_feedback($feedback_obj);

							//update candidate model for status
							if($decision==1){
								$this->candidate_model->set_status($this->input->post('uid'),1);
							}
							else{
									if($another_round==1){
										$this->candidate_model->set_status($this->input->post('uid'),0);
									}
							}

						}
						redirect('candidate/'.$this->input->post('uid'));
					}
			else
			 {
					redirect('login');
			}
}

	public function save_feedback()
	{
			$this->load->model('feedback_model');
			if(!empty($this->session->userdata('username')))
			{
				//check for post data
				// var_dump($this->input->post());
				// die();
				if ($this->input->post('submit') == "Submit")
				{
					//we have post data
					$qns = explode(',',$this->input->post('q_ids'));
					if(empty($this->input->post('decision'))){
						$decision=0;
					}
					else {
						$decision=1;
					}
					//TODO TRIGGER EMAIL IF DECISION FINALISED
					if(empty($this->input->post('another_round'))){
						$another_round=0;
					}
					else {
						$another_round=1;
					}
					$loopcounter=0;
					foreach ($qns as $qn_id) {
						$loopcounter++;
						if($qn_id!=''){
							$commentvar = 'comment'. $qn_id;
							$ratingvar = 'rating'.$qn_id;
							$feedback_obj = array(
								'intw_id'=>$this->input->post('interview'),
								'ques_id'=>$qn_id,
								'cand_id'=>$this->input->post('uid'),
								'user_id'=>$this->session->userdata('username'),
								'CommentText'=>$this->input->post($commentvar),
								'rating'=>$this->input->post($ratingvar)
							);
							$this->feedback_model->save_feedback($this->input->post('interview'),$qn_id,$feedback_obj);
							// SAVED FEEDBACK
							// NOW UPDATE THE INTERVIEW OBJECT AND MOVE ON
							//
							// echo "";
							// // log_message('debug',var_dump($commentvar));
							// log_message('debug',var_dump($feedback_obj));
						}
						$this->feedback_model->update_intw(
							$this->input->post('interview'),
							$decision,
							$another_round
						);
				}
				redirect('candidate/'.$this->input->post('uid'));
			}
				redirect('all');
		}
		else {
				redirect('login');
		}
	}
	public function report($url_id)
	{
		if(!empty($this->session->userdata('username')))
		{

			$this->load->model('report_model');
			$d['v'] = 'report';
			$d['uid']= $url_id;
			$d['cname'] = $this->report_model->find_name($url_id);
			$d['data']=$this->report_model->list_intw_ids($url_id);
			$this->load->view('template', $d);
		}
		else {
			redirect('login');
		}
	}
	public function reject($url_id)
	{
		if(!empty($this->session->userdata('username')))
		{
			date_default_timezone_set('Asia/Calcutta');
			$this->load->model('candidate_model');
			$this->load->model('login_model');
			$this->candidate_model->reject($url_id);
			$cand_email=$this->candidate_model->get_email($url_id)[0]['email'];
			$intwr_email= $this->login_model->get_email($this->session->userdata('username'));
			$intwr_email = $intwr_email[0]['email'];
			#CREATING INTERVIEW OBJECT
			##TODO EMAIL TRIGGERS
			//load email helper
			$ci = get_instance();
			$ci->load->library('email');
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = "zomatoemail@gmail.com";
			$config['smtp_pass'] = "zomato123";
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";

			$ci->email->initialize($config);
			// EMAIL TO CANDIDATE
			$ci->email->from('zomatoemail@gmail.com', 'Hiring');
			$ci->email->to($cand_email);
			$list = array($intwr_email,'fixed_email@zomato.com');
			$ci->email->bcc($list);
			$this->email->reply_to('palash.oswal@zomato.com', 'Hiring');
			$ci->email->subject('APPLICATION REJECTED');
			$ci->email->message(
			"Your Application for Zomato has been rejected ");
			$this->email->send();
			redirect('/candidate/'.$url_id);
		}
		else {
			redirect('login');
		}
	}
}
