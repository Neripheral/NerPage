<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class Users_model extends Head_model{
    
    public function getMatchingUser($user){
        //@idea optimize query to return only rows $user doesn't contain
        $this->db->select(array("id", "username", "password", "email", "permissions"));
        $this->db->from("Users");
        $this->db->where($user->getAsArray_select());
        $answer = $this->db->get()->result_array();
        if(empty($answer))
            return false;
        $answer = $answer[0];
        return $user->setAll($answer);
    }

    
    public function insert($userToAdd){
        $this->db->set($userToAdd->getAsArray_insert());
        $this->db->insert("Users");
        $error = $this->db->error();
        if($error["code"] == 0)
            return true;
        return $error;
    }
}