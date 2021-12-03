<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Medicine";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/medicine/index");
        $this->load->view("admin/template/footer");
    }

}

