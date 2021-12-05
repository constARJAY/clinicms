<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Settings";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/setting/index");
        $this->load->view("admin/template/footer");
    }

}

