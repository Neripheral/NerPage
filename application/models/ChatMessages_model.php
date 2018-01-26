<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");
require_once(APPPATH."libraries/class/ChatMessage.php");

class ChatMessages_model extends Head_model{
    
    public function get($lastMessageId = 0){
        $this->db->select(array("ChatMessages.id", "Users.username", "ChatMessages.content"));
        $this->db->from("ChatMessages");
        $this->db->order_by("ChatMessages.id", "DESC");
        $this->db->limit(20);
        $this->db->where("ChatMessages.id > $lastMessageId");
        $this->db->join("Users", "ChatMessages.userId = Users.id", "left");
        return $this->db->get()->result_array();
    }
    
    
    public function insert($messageToAdd){
        $this->db->set($messageToAdd->getAsArray_insert());
        $this->db->insert("ChatMessages");
        $error = $this->db->error();
        if($error["code"] == 0)
            return true;
        return $error;
    }
}

