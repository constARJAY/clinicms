<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/dashboard/index");
        $this->load->view("admin/template/footer");
    }

}

