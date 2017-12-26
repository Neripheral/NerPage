<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");
require_once(APPPATH."libraries/class/ChatMessage.php");


class Chat extends Head_Controller{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------INPUT_FETCH-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function fetchInput_sendMessage(){
        $wantedFields = array("message");
        $messageData = $this->fetchInput($wantedFields);
        return $messageData;
    }
    
    public function sendMessage(){
        $messageData = $this->fetchInput_sendMessage();
        $chatMessage = new ChatMessage($this->getLoggedUser()->getId(), $messageData["message"]); 
        
        $this->load->model("ChatMessage_model");
        $this->ChatMessage_model->insert($chatMessage);
    }
    
    public function getMessages($lastMessageId = null){
        if($lastMessageId === null)
            $lastMessageId = intval($this->input->post("lastMessageId"));
        log_message("debug", var_export($_POST, true));
        $this->load->model("ChatMessage_model");
        return $this->ChatMessage_model->get($lastMessageId);
    }
    
    public function ajaxGetMessages(){
        $value = json_encode($this->getMessages());
        log_message("debug", $value);
        echo $value;
    }
    
    public function show_chat_view(){
        
    }
}










/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

