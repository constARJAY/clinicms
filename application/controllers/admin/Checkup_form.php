<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Check-up Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/checkup_form/index");
        $this->load->view("admin/template/footer");
    }

}

