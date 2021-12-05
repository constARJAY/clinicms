<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {

    public function getTablePatientData()
    {
        $sql   = "SELECT * FROM patient WHERE is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }    

    public function getProfileInformation($patientID = 0)
    {
        $sql = "
        SELECT
            p.*, pt.name AS pt_name, c.name AS course_name, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname
        FROM patients AS p
            LEFT JOIN patient_type AS pt USING(patient_type_id)
            LEFT JOIN courses AS c USING(course_id)
        WHERE patient_id = $patientID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    public function getCheckupHistory($patientID = 0)
    {
        $sql = "
        SELECT
            cu.*,
            DATE_FORMAT(cu.created_at, '%M %d, %Y') AS check_up_date,
            s.name AS service_name
        FROM check_ups AS cu
            LEFT JOIN services AS s USING(service_id)
        WHERE patient_id = $patientID AND cu.is_deleted = 0";
        $query = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getCheckup($checkUpID = 0)
    {
        $sql    = "SELECT * FROM check_ups WHERE check_up_id = $checkUpID";
        $query  = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    public function getTreatment($checkUpID = 0)
    {
        $sql    = "SELECT * FROM check_up_treatments WHERE check_up_id = $checkUpID";
        $query  = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getMedicine($checkUpID = 0)
    {
        $sql    = "SELECT cup.*, m.name AS medicine_name FROM check_up_medicines AS cup LEFT JOIN medicines AS m USING(medicine_id) WHERE check_up_id = $checkUpID";
        $query  = $this->db->query($sql);
        return $query ? $query->result_array() : [];
    }

    public function getCheckupData($checkUpID = 0)
    {
        return [
            "checkup"   => $this->getCheckup($checkUpID),
            "treatment" => $this->getTreatment($checkUpID),
            "medicine"  => $this->getMedicine($checkUpID),
        ];
    }

}

