<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."third_party/smarty/Smarty.class.php";
require_once(APPPATH."libraries/class/ChatMessage.php");
require_once("Head_Library.php");

class Chat extends Head_Library{
    public function sendMessage($userId, $content){
        $chatMessage = new ChatMessage(array("userId" => $userId, "content" => $content));
        
        $this->ci->load->model("ChatMessages_model");
        $this->ci->ChatMessages_model->insert($chatMessage);
    }
    
    public function getMessages($lastMessageId){
        if(!is_int($lastMessageId))
            return false;
        $this->ci->load->model("ChatMessages_model");
        return $this->ci->ChatMessages_model->get($lastMessageId);
    }
    
    public function ajaxGetMessages($lastMessageId = 0){
        $messages = $this->getMessages($lastMessageId);
        $jsonData = json_encode($messages);
        return $jsonData;
    }
    
    public function get_chat_section(){
        $toPass = array(
            "MESSAGES" => $this->getMessages(0)
        );
        return $this->ci->codebuilder->prepareSection(array("chat", $toPass), "chat");
    }
}