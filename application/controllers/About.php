<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

    public function index()
    {
        $data['title'] = "About Us";
        $this->load->view("website_template/header", $data);
        $this->load->view("about/index",$data);
        $this->load->view("website_template/footer");
    }

}

