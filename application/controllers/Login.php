<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
  public function index(){
  $this->load->model("Login_model");

    
    if(isset($this->session->userdata['admin']['admin_id'])){
      redirect('http://localhost/bookstore/index.php/Profile','refresh');
    }
    else{
      $data['title'] = "BooksThatYouLove Admin - Giriş";

 
      if($this->input->post()){

        $admin = $this->Login_model->getAdmin($this->input->post());

        

        if(empty($admin)){
          $this->session->set_flashdata('error', 'Hatalı kullanıcı adı veya şifre girdiniz.');
          header("Location: ".base_url());
        }
        else{
          $this->session->set_userdata('admin',$admin);
          header("Location: ".base_url());
        }
      }
      else{
        $this->load->view('layouts/login',$data);
      }
    }
  }

  public function out(){
    $this->session->sess_destroy();
    header("Location: ".base_url());
  }
}