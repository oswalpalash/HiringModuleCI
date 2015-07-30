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
          if(!empty($this->session->userdata('username')))
          {
              redirect('home');
          }
          if ($this->input->post('btn_login') == "Login")
          {
              // echo "hi";
              // die();
              $this->load->model('login_model');
              $username = $this->input->post("txt_username");
              $password = $this->input->post("txt_password");
              $usr_result = $this->login_model->get_user($username, $password);
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
                    redirect('');
               }
          }
          else {
            $this->load->view('login_view');
          }
     }

}?>
