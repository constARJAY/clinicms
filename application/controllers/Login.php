<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'login');
        $this->load->library('encryption');
    }

    public function index()
    {
        $data['title'] = "Login";

        if ($this->session->has_userdata('sessionID')) {
            redirect('admin/dashboard','refresh');
        } else {
            $this->load->view("admin/login/index", $data);
        }

    }

    public function authenticate()
    {
        $email    = $this->input->post("email");
        $password = $this->input->post("password");

        $this->load->library('encryption');

        $authenticate = $this->login->authenticate($email, $password);
        if ($authenticate) {
            redirect('admin/dashboard','refresh');
        } else {
            $this->session->set_flashdata('feedback', 'error');
            redirect(base_url('login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy('sessionID');
        redirect(base_url('login'));
    }

}

