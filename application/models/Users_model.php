<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class Users_model extends Head_model{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
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
        $query = $this->getQuery_select(NULL, $conditions);
        $data = $this->db->query($query)->result_array();
        
        if(empty($data))
            return null;
        $data = $data[0];
        return new User($data["username"], $data["password"], $data["email"], $data["permission"]);
    }
    /* ------UPDATE------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------INSERT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function insert(){
        $userData = $userToAdd->getAsArray();
        unset($userData["id"]);
        $query = $this->getQuery_insert($userData);
        $this->db->query($query);
        $error = $this->db->error();
        if($error["code"] == 0)
            return true;
        return $error;
    }
}