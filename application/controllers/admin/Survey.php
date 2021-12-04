<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/Survey_model", "survey");
    }

    public function index()
    {
        $data['title'] = "Survey";
        $this->load->view("admin/template/header", $data);
        $this->load->view("admin/survey/index");
        $this->load->view("admin/template/footer");
    }

    public function take()
    {
        $surveyID = $this->input->get("id");
        $information = $this->survey->getSurveyInformation($surveyID);

        if ($information) {
            $data = [
                "title"       => "Survey",
                "surveyID"    => $surveyID,
                "information" => $information
            ];
            $this->load->view("admin/survey/take", $data);
        } else {
            redirect('admin/survey');
        }
    }

    public function saveSurvey()
    {
        $surveyID  = $this->input->post("surveyID");
        $data = $this->input->post("data");

        $surveyData = ["status" => 1];
        if ($data && !empty($data)) {
            foreach($data as $dt) {
                $question = $dt["question"];
                $answer   = $dt["answer"];

                $surveyData["$question"] = $answer;
            }
        }
        $saveSurvey = $this->survey->saveSurvey($surveyID, $surveyData);
        echo json_encode($saveSurvey);
    }

}

