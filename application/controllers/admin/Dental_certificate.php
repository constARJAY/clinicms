<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use setasign\Fpdi\Fpdi;

class Dental_certificate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Dental Certificate";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/dental_certificate/index");
        $this->load->view("admin/template/footer");
    }

    public function print()
    {
        $this->load->view("admin/dental_certificate/print");
    }

}

