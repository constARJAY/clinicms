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
            "totalAppointment"        => $totalAppointment
        ];
    }    

}

