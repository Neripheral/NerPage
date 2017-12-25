<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");
require_once(APPPATH."libraries/class/ChatMessage.php");


class Chat extends Head_Controller{
    public function sendMessage(){
        log_message("error", var_export($_POST, true));
    }
    
    public function show_chat_view(){
        
    }
}