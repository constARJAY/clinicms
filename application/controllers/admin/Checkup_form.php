<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup_form extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/CheckupForm_model", "checkupform");
    }

    public function index()
    {
        $data['title'] = "Check-up Form";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/checkup_form/index");
        $this->load->view("admin/template/footer");
    }

    public function insertCheckupForm()
    {
        $service_id            = $this->input->post("service_id");           
        $clinic_appointment_id = $this->input->post("clinic_appointment_id");
        $patient_id            = $this->input->post("patient_id");           
        $temperature           = $this->input->post("temperature");          
        $pulse_rate            = $this->input->post("pulse_rate");           
        $respiratory_rate      = $this->input->post("respiratory_rate");     
        $blood_pressure        = $this->input->post("blood_pressure");       
        $random_blood_sugar    = $this->input->post("random_blood_sugar");   
        $others                = $this->input->post("others");               
        $treatment             = $this->input->post("treatment");            
        $medicine              = $this->input->post("medicine");             
        $recommendation       = $this->input->post("recommendation");       

        $data = [
            'clinic_appointment_id' => $clinic_appointment_id,
            'service_id'            => $service_id,
            'patient_id'            => $patient_id,
            'temperature'           => $temperature,
            'pulse_rate'            => $pulse_rate,
            'respiratory_rate'      => $respiratory_rate,
            'blood_pressure'        => $blood_pressure,
            'random_blood_sugar'    => $random_blood_sugar,
            'others'                => $others,
            'recommendation'        => $recommendation,
        ];

        $insertCheckupForm = $this->checkupform->insertCheckupForm($data);
        if ($insertCheckupForm) {
            $result = explode("|", $insertCheckupForm);
            if ($result[0] == "true") {
                $check_up_id = $result[1];

                $treatmentData = $medicineData = [];
                if ($treatment && !empty($treatment)) {
                    foreach($treatment as $treat) {
                        $treatmentData[] = [
                            "check_up_id"  => $check_up_id,
                            "tooth_number" => $treat['tooth_number'],
                            "status"       => $treat['status'],
                        ];
                    }
                }

                if ($medicine && !empty($medicine)) {
                    foreach($medicine as $med) {
                        $medicineData[] = [
                            "check_up_id" => $check_up_id,
                            "medicine_id" => $med['medicine_id'],
                            "quantity"    => $med['quantity'],
                        ];
                    }
                }

                $insertTreatmentMedicine = $this->checkupform->insertTreatmentMedicine($treatmentData, $medicineData);
            }
        }

        echo json_encode($insertCheckupForm);
    }

    // public function add()
    // {
    //     $data['title'] = "Add Check-up Form";
    //     $this->load->view("admin/template/header", $data);
    //     $this->load->view("admin/checkup_form/add");
    //     $this->load->view("admin/template/footer");
    // }

}

