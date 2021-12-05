<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anouncement extends CI_Controller {

    public function index()
    {
        $data['title'] = "Anouncement";
        $this->load->view("website_template/header", $data);
        $this->load->view("anouncement/index",$data);
        $this->load->view("website_template/footer");
    }

}

