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

    public function profile()
    {
        $patientID = $this->input->get("id");

        $data['title'] = "Patient";
        $data['information'] = $this->patient->getProfileInformation($patientID);
        $data['checkups']    = $this->patient->getCheckupHistory($patientID);
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/patient/profile");
        $this->load->view("admin/template/footer");
    }

    public function getCheckupData()
    {
        $checkUpID = $this->input->post("checkUpID");
        echo json_encode($this->patient->getCheckupData($checkUpID));
    }

}

