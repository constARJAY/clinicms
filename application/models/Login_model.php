<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function authenticate($email = "", $password = "")
    {
        if ($email && $password)
        {
            $sql    = "SELECT * FROM users WHERE email = BINARY '$email' AND password = BINARY '$password'";
            $query  = $this->db->query($sql);
            $result = $query ? $query->row() : null;
            if ($result)
            {
                $userID = $result->user_id ?? 0;
                $this->session->set_userdata('sessionID', $userID);
                return true;
            }
        }
        return false;
    }

    public function authenticateWebsite($email = "", $password = "")
    {
        if ($email && $password)
        {
            $sql    = "SELECT * FROM patients WHERE email = BINARY '$email' AND password = BINARY '$password'";
            $query  = $this->db->query($sql);
            $result = $query ? $query->row() : null;
            if ($result)
            {
                $patientID = $result->patient_id ?? 0;
                $this->session->set_userdata('patientID', $patientID);
                echo $patientID;
                return true;
            }
        }
        return false;
    }

}

