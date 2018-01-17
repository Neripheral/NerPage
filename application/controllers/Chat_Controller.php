<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");
require_once(APPPATH."libraries/class/ChatMessage.php");


class Chat_Controller extends Head{
    private function fetchInput_sendMessage(){
        $wantedFields = array("content");
        $messageData = $this->fetchdata->fetchInput($wantedFields);
        return $messageData;
    }
    
    public function sendMessage(){
        $this->load->library("chat");
        
        $content = $this->fetchInput_sendMessage()["content"];
        $this->chat->sendMessage($this->usermanager->getLoggedUser()->getId(), $content);
    }
        
    public function ajaxGetMessages(){
        $this->load->library("chat");
        $lastMessageId = (int)$this->input->post("lastMessageId");
        echo $this->chat->ajaxGetMessages($lastMessageId);
    }
}










/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

