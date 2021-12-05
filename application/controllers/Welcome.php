<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        $data['title'] = "Home";
        $this->load->view("website_template/header", $data);
        $this->load->view("welcome/index",$data);
        $this->load->view("website_template/footer");
    }

}

