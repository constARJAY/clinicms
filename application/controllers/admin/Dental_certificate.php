<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use setasign\Fpdi\Fpdi;

class Dental_certificate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/DentalCertificate_model', 'dentalcertificate');
    }

    public function index()
    {
        $data['title'] = "Dental Certificate";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/dental_certificate/index");
        $this->load->view("admin/template/footer");
    }

    public function print()
    {
        $dentalCertificateID = $this->input->get("id");
        $dentalCertificateData = $this->dentalcertificate->getDentalCertificateData($dentalCertificateID);
        // echo json_encode($dentalCertificateData);
        if ($dentalCertificateData) {
            $data['title']       = "PRINT DENTAL CERTIFICATION";
            $data['information'] = $dentalCertificateData;
            $this->load->view("admin/dental_certificate/print", $data);
        } else {
            redirect(base_url('admin/dental_certificate'),'refresh');
        }
        
    }

}

