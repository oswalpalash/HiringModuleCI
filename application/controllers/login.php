<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('login_model');
     }

     public function index()
     {
          //get the posted values
          $username = $this->input->post("txt_username");
          $password = $this->input->post("txt_password");

          // log_message('debug',var_dump($this->session->userdata('username')));
          if(!empty($this->session->userdata('username')))
          {
              redirect('all');
          }
          if ($this->input->post('btn_login') == "Login")
          {
               $usr_result = $this->login_model->get_user($username, $password);
              //  echo $usr_result;
               if ($usr_result > 0) //active user record is present
               {
                    //set the session variables
                    $sessiondata = array(
                         'username' => $username,
                         'loginuser' => TRUE
                    );
                    $this->session->set_userdata($sessiondata);
                    redirect('/home');
                    $candidata = $this->candidate_model->get_all();
                    $this->load->view('list_candidates',$candidata);
               }
               else
               {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                    // echo "$usr_result";
                    // redirect('');
               }
          }
          else {
            $this->load->view('login_view');
          }
     }

}?>
