<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckupForm_model extends CI_Model {

    public function insertCheckupForm($data = [])
    {
        if ($data && !empty($data)) 
        {
            $query = $this->db->insert("check_ups", $data);
            $clinicAppointmentID = $data['clinic_appointment_id'];
            
            $insertID = $this->db->insert_id();
            $this->db->update('clinic_appointments', ['is_done' => 1], ['clinic_appointment_id' => $clinicAppointmentID]);
            
            return $query ? "true|$insertID|Successfully saved!" : "false|System error: Please contact the system administrator for assistance!";
        }
        return "false|System error: Please contact the system administrator for assistance!";
    }

    public function getMedicine($medicineID)
    {
        $sql   = "SELECT * FROM medicines WHERE medicine_id = $medicineID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    public function insertTreatmentMedicine($treatmentData = [], $medicineData = [])
    {
        if ($treatmentData && !empty($treatmentData))
        {
            $query = $this->db->insert_batch("check_up_treatments", $treatmentData);
        }

        if ($medicineData && !empty($medicineData))
        {
            $query = $this->db->insert_batch("check_up_medicines", $medicineData);

            foreach($medicineData as $med) 
            {
                $checkUpID  = $med['check_up_id'];
                $medicineID = $med['medicine_id'];
                $quantity   = $med['quantity'] ?? 0;

                $medicine = $this->getMedicine($medicineID);
                if ($medicine)
                {
                    $stocks    = $medicine->quantity ?? 0;
                    $remaining = $stocks - $quantity;
                    $remaining = $remaining > 0 ? $remaining : 0;

                    $medicineTransactionData = [
                        "check_up_id" => $checkUpID,
                        "medicine_id" => $medicineID,
                        "stocks"      => $stocks,
                        "quantity"    => $quantity,
                        "remaining"   => $remaining,
                    ];

                    $query2 = $this->db->insert("medicine_transactions", $medicineTransactionData);
                    if ($query2)
                    {
                        $this->db->update("medicines", ["quantity" => $remaining], ["medicine_id" => $medicineID]);
                    }
                }
            }
        }
    }

    public function insertSurvey($checkUpID, $patientID)
    {
        $data = [
            "check_up_id" => $checkUpID,
            "patient_id"  => $patientID,
            "status"      => 0,
        ];
        $query = $this->db->insert("surveys", $data);
        return $query ? true : false;
    }

}

