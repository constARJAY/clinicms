<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DentalCertificate_model extends CI_Model {

    public function getDentalCertificateData($dentalCertificateID = 0)
    {
        $sql = "
        SELECT 
            dc.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname, age, gender
        FROM dental_certificates AS dc
            LEFT JOIN patients AS p USING(patient_id)
        WHERE dental_certificate_id = $dentalCertificateID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

}

