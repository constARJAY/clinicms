<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function getTotalPatient()
    {
        $sql   = "SELECT COUNT(*) AS total FROM patients WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->row()->total : 0;
    }

    public function getTotalAppointment()
    {
        $sql    = "SELECT SUM(IF(service_id = 1,1,0)) AS medical, SUM(IF(service_id = 2,1,0)) AS dental FROM clinic_appointments WHERE is_deleted = 0";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;
        return [$result->medical ?? 0, $result->dental ?? 0];
    }

    public function getTotalPatientType($patientTypeID = 0)
    {
        $sql   = "SELECT COUNT(*) AS total FROM patients WHERE patient_type_id = $patientTypeID";
        $query = $this->db->query($sql);
        return $query ? $query->row()->total : 0;
    }

    public function getPatientType()
    {
        $sql    = "SELECT * FROM patient_type WHERE is_deleted = 0";
        $query  = $this->db->query($sql);
        $result = $query ? $query->result_array() : [];

        $data = [];
        foreach($result as $res) 
        {
            $data[] = [
                'patient_type_id' => $res['patient_type_id'],
                'name'            => $res['name'],
                'count'           => $this->getTotalPatientType($res['patient_type_id'])
            ];
        }
        return $data;
    }

    public function getMedicine()
    {
        $sql   = "SELECT * FROM medicines WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getDashboardData()
    {
        $totalPatient = $this->getTotalPatient();
        $appointment  = $this->getTotalAppointment();
        $totalMedicalAppointment = $appointment[0];
        $totalDentalAppointment  = $appointment[1];
        $totalAppointment        = $appointment[0] + $appointment[1];

        return [
            "totalPatient" => $totalPatient,
            "totalMedicalAppointment" => $totalMedicalAppointment,
            "totalDentalAppointment"  => $totalDentalAppointment,
            "totalAppointment"        => $totalAppointment,
            "patientType"             => $this->getPatientType(),
            "medicine"                => $this->getMedicine(),
        ];
    }    

}

