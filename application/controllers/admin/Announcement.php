<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = "Announcement";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/announcement/index");
        $this->load->view("admin/template/footer");
    }

}

