<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anouncement extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("SystemOperations_model", "systemoperations");
    }

    public function index()
    {
        $data['title']          = "Anouncement";
        $data["anouncement"]    =  $this->systemoperations->getTableData("announcements","announcements.*, (SELECT CONCAT(lastname,', ',firstname,' ',middlename) FROM users WHERE user_id = '1' ) as fullname","is_deleted = '0'");
        $this->load->view("website_template/header", $data);
        $this->load->view("anouncement/index",$data);
        $this->load->view("website_template/footer");
    }

}

