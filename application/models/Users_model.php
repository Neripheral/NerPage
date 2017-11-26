<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class Users_model extends Head_model{
    // Returns query executed to add a new user to the database
    public function getInsertQuery($username, $password, $email){
        $data = array(
            "username" => $username,
            "password" => $password,
            "email" => $email,
            "permissions" => "guest"
        );
        return $this->db->set($data)->get_compiled_insert("Users");
    }
    
    // Gets array of $columns and array($column=>value) condition
    public function getSelectQuery($columns, $condition){
        return $this->db->select(implode(",", $columns), $condition);
    }
    
    public function insert($username, $password, $email, $permissions){
        //@todo registering user - contact with database and redirecting
        $query = $this->getInsertQuery($username, $password, $email, $permissions);
        $this->db->query($query);
    }
}