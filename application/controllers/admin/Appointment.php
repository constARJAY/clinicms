<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Appointment";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/appointment/index");
        $this->load->view("admin/template/footer");
    }

}

