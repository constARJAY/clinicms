<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Patient_model', 'patient');
    }

    public function index()
    {
        $data['title'] = "Patient";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/patient/index");
        $this->load->view("admin/template/footer");
    }

    public function getTablePatientData()
    {
        $patient = $this->patient->getTablePatientData();
        echo json_encode($patient);
    }

}

