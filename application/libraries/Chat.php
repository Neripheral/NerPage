<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/class/ChatMessage.php");


class Chat{
    private $ci;     

    private function fetchInput_sendMessage(){
        $wantedFields = array("message");
        $messageData = $this->ci->fetchdata->fetchInput($wantedFields);
        return $messageData;
    }
    
    public function sendMessage(){
        $messageData = $this->fetchInput_sendMessage();
        $chatMessage = new ChatMessage($this->ci->usermanager->getLoggedUser()->getId(), $messageData["message"]);
        
        $this->ci->load->model("ChatMessage_model");
        $this->ci->ChatMessage_model->insert($chatMessage);
    }
    
    public function getMessages($lastMessageId = null){
        log_message("debug", "testing");
        if($lastMessageId === null)
            $lastMessageId = intval($this->ci->input->post("lastMessageId"));
            log_message("debug", "testing");
        $this->ci->load->model("ChatMessage_model");
        return $this->ci->ChatMessage_model->get($lastMessageId);
    }
    
    public function ajaxGetMessages(){
        $value = json_encode($this->getMessages());
        echo $value;
    }
    
    public function get_chat_view($returnContent = true){
        $toPass = array("fromController" => array(
            "MESSAGES" => $this->getMessages(0)
        ));
        $content = $this->ci->load->view("chat", $toPass, true);
        
        if($returnContent)
            return $content;
        else
            $this->ci->codebuilder->show(
                $this->ci->codebuilder->wrap_html(
                    $content,
                    "navbar_chat"
                )
            );
    }
    
    public function __construct(){
        $this->ci = &get_instance();
    }
}