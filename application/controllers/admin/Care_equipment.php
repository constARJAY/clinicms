<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Care_equipment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Care Equipment";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/care_equipment/index");
        $this->load->view("admin/template/footer");
    }

}

