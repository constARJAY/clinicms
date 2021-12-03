<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First_aid_kit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "First-aid Kit";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/first_aid_kit/index");
        $this->load->view("admin/template/footer");
    }

}

