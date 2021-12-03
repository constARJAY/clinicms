<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemOperations_model extends CI_Model {

    public function getTableData($tableName = null, $columnName = "*", $searchFilter = "", $orderBy = "", $groupBy = "", $others = "")
    {
        if ($tableName) {
            $columnName  = $columnName   ? $columnName : "*";
            $whereFilter = $searchFilter ? "WHERE $searchFilter" : "";
            $orderFilter = $orderBy ? "ORDER BY $orderBy" : "";
            $groupFilter = $groupBy ? "GROUP BY $groupBy" : "";
            $sql         = "SELECT $columnName FROM $tableName $whereFilter $orderFilter $groupFilter $others";
            $query       = $this->db->query($sql);
            return $query ? $query->result_array() : [];
        }
        return [];
    }


    public function getFeedbackMessage($feedback, $method) {
        if ($method) {
            switch($method) {
                case "update":
                    return "$feedback updated successfully!";
                case "add":
                    return "$feedback added successfully!";
                case "save":
                    return "$feedback saved successfully!";
                case "submit":
                    return "$feedback submitted successfully!";
                case "approve":
                    return "$feedback approved successfully!";
                case "reject":
                    return "$feedback denied successfully!";
                case "drop":
                    return "$feedback dropped successfully!";
                case "cancelform":
                default:
                    return "$feedback cancelled successfully!";
            }
        }
    }

    public function insertTableData($tableName = null, $tableData = [], $feedback = "Data", $method = false)
    {
        if ($tableName) {
            $query = $this->db->insert($tableName, $tableData);
            if ($query) {
                $insertID = $this->db->insert_id();
                $method = $method ? $method : "add";
                $feedbackMessage = $this->getFeedbackMessage($feedback, $method);
                return "true|$feedbackMessage|$insertID";
            }
            return "false|System error: Please contact the system administrator for assistance!";
        }
        return "false|System error: Please contact the system administrator for assistance!";
    }

    public function updateTableData($tableName = null, $tableData = [], $whereFilter = "", $feedback = "Data", $method = false)
    {
        if ($tableName) {
            if ($whereFilter) {
                $query = $this->db->update($tableName, $tableData, $whereFilter);
                $method = $method ? $method : "update";
                $feedbackMessage = $this->getFeedbackMessage($feedback, $method);
                $idArr = explode("=", $whereFilter);
                return $query ? "true|$feedbackMessage|$idArr[1]" : "false|System error: Please contact the system administrator for assistance!";
            } else {
                return "false|Invalid where clause in mysql";
            }
        }
        return "false|System error: Please contact the system administrator for assistance!";
    }

}
