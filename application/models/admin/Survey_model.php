<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getSurveyInformation($surveyID = 0)
    {
        $sql = "
        SELECT 
            s.*, patient_type_id 
        FROM surveys AS s 
            LEFT JOIN patients AS p USING(patient_id) 
        WHERE survey_id = $surveyID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

    public function saveSurvey($surveyID = 0, $data = [])
    {
        // return $data;
        if ($surveyID && !empty($data))
        {
            $query = $this->db->update("surveys", $data, "survey_id=$surveyID");
            return $query ? "true|Success" : "false|There was an error saving your survey";
        }
        return "false|There was an error saving your survey";
    }

}

