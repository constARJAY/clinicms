<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Users";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/users/index");
        $this->load->view("admin/template/footer");
    }

}

