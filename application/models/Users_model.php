<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class Users_model extends Head_model{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function convertPassword(&$userData){
        return $userData["password"];
    }
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------QUERIES------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */ 
    public function getQuery_insert($userData){
        return $this->db->set($userData)->get_compiled_insert("Users");
    }
    
    
    // Arg: array of $columns and array($column=>value) condition
    public function getQuery_select($columns, $condition){
        if($columns != NULL)
            $this->db->select(implode(",", $columns));
        $this->db->where($condition);
        return $this->db->get_compiled_select("Users");
    }
    /* ------SELECT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Arg: array of $columns and array($column=>value) condition
    public function getMatchingUser($conditions){
        $this->convertPassword($conditions);
        $query = $this->getQuery_select(NULL, $conditions);
        $data = $this->db->query($query)->result_array();
        
        if(empty($data))
            $data = NULL;
        else
            $data = $data[0];
        return $data;
    }
    /* ------UPDATE------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------INSERT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function insert($userData){
        //@todo registering user - redirecting
        $this->convertPassword($userData);
        $query = $this->getQuery_insert($userData);
        $this->db->query($query);
    }
}