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

    public function getCustomerSatisfactory()
    {
        $sql = "
        SELECT 
            AVG(q1)  AS q1, 
            AVG(q2)  AS q2, 
            AVG(q3)  AS q3, 
            AVG(q4)  AS q4, 
            AVG(q5)  AS q5, 
            AVG(q6)  AS q6, 
            AVG(q7)  AS q7, 
            AVG(q8)  AS q8, 
            AVG(q9)  AS q9, 
            AVG(q10) AS q10 
        FROM surveys
        WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    public function getSurveyResult($year = '', $month = '')
    {
        $sql = "
        SELECT 
            ((AVG(q1) + AVG(q2) + AVG(q3) + AVG(q4) + AVG(q5) + AVG(q6) + AVG(q7) + AVG(q8) + AVG(q9) + AVG(q10))/(COUNT(*)*10)) AS percent
        FROM surveys WHERE YEAR(created_at) = '$year' AND MONTHNAME(created_at) = '$month'";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;
        return $result->percent ?? 0;
    }

    public function getMonthlySurvey()
    {
        $data = [];

        $month = [
            'January', 
            'February', 
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];
        $year = date('Y');
        foreach($month as $mon) 
        {
            $data[] = [
                'month' => $mon,
                'total' => $this->getSurveyResult($year, $mon)
            ];
        }
        return $data;
    }

    public function getTotalRater($patientTypeID = 0)
    {
        $sql    = "SELECT COUNT(*) AS total FROM surveys LEFT JOIN patients USING(patient_id) WHERE patient_type_id = $patientTypeID";
        $query  = $this->db->query($sql);
        $result = $query ? $query->row() : null;
        return $result ? $result->total ?? 0 : 0;
    }

    public function getRater()
    {
        $data = [];

        $sql    = "SELECT * FROM patient_type WHERE is_deleted = 0";
        $query  = $this->db->query($sql);
        $result = $query ? $query->result_array() : [];
        foreach($result AS $res)
        {
            $patientTypeID = $res['patient_type_id'];
            $data[] = [
                'patient_type_id' => $patientTypeID,
                'name'            => $res['name'],
                'total'           => $this->getTotalRater($patientTypeID)
            ];
        }
        return $data;
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
            "customerSatisfactory"    => $this->getCustomerSatisfactory(),
            "monthlySurveyResult"     => $this->getMonthlySurvey(),
            "rater"                   => $this->getRater()
        ];
    }    

}

