<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");
require_once(APPPATH."libraries/class/ChatMessage.php");

class ChatMessages_model extends Head_model{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------QUERIES------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getQuery_joinUsers($query, $columns, $joinOn){
        $this->db->select(implode(",", $columns));
        $this->db->from("(".$query.") as ChatMessages");
        $this->db->join("Users", $joinOn);
        return $this->db->get_compiled_select();
    }
    
    public function getQuery_select($columns, $lastMessageId, $dbTable){
        $this->db->select(implode(",", $columns));
        $this->db->where("id > $lastMessageId");
        $this->db->order_by("id", "DESC");
        $this->db->limit(30);
        return $this->db->get_compiled_select($dbTable);
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
        $queryChatMessages = $this->getQuery_select($columns, $lastMessageId, "ChatMessages");
        $columns = array(
            "ChatMessages.id",
            "username",
            "content"
        );
        $query = $this->getQuery_joinUsers($queryChatMessages, $columns, "userId=Users.id");
        $messages = $this->db->query($query)->result_array();
        return $messages;
    }
    
    public function insert($messageToAdd){
        $query = $this->getQuery_insert($messageToAdd, "ChatMessages");
        log_message("debug", $query);
        $this->db->query($query);
        $error = $this->db->error();
        if($error["code"] == 0)
            return true;
        return $error;
    }
}

