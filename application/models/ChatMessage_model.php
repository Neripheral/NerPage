<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class ChatMessage_model extends Head_model{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------QUERIES------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getQuery_insert($messageData){
        return $this->db->set($messageData)->get_compiled_insert("ChatMessages");
    }
    
    public function getQuery_joinUsers($query, $columns, $joinOn){
        $this->db->select(implode(",", $columns));
        $this->db->from("(".$query.") as ChatMessages");
        $this->db->join("Users", $joinOn);
        return $this->db->get_compiled_select();
    }
    
    public function getQuery_select($columns, $lastMessageId = 0){
        if(!is_int($lastMessageId))
            return false;
        $this->db->select(implode(",", $columns));
        $this->db->where("id > $lastMessageId");
        $this->db->order_by("id", "DESC");
        $this->db->limit(30);
        return $this->db->get_compiled_select("ChatMessages");
    }
    /* ------SELECT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------UPDATE------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------INSERT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function get($lastMessageId = 0){
        if(!is_int($lastMessageId))
            return false;
        $columns = array(
            "id",
            "userId",
            "content"
        );
        $queryChatMessages = $this->getQuery_select($columns, $lastMessageId);
        $columns = array(
            "ChatMessages.id",
            "username",
            "content"
        );
        $query = $this->getQuery_joinUsers($queryChatMessages, $columns, "userId=Users.id");
log_message("debug", $query);
        return $this->db->query($query)->result_array();
    }
    
    public function insert($messageToAdd){
        $messageData = $messageToAdd->getAsArray();
        unset($messageData["id"]);
        $query = $this->getQuery_insert($messageData);
        $this->db->query($query);
        $error = $this->db->error();
        if($error["code"] == 0)
            return true;
        return $error;
    }
}

