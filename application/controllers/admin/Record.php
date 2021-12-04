<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Record extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Record";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/record/index");
        $this->load->view("admin/template/footer");
    }

}

