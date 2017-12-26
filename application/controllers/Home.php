<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Chat.php");

class Home extends Chat{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function home_view(){
        
        if($this->userIsLogged()){
            $this->header_view("Home", array("js" => array(base_url("js/chatController.js"))));
            $toPass = array("fromController" => array(
                "MESSAGES" => $this->getMessages(0)
            ));
            $toPass = array("fromController" => array(
                "chat" => $this->load->view("chat", $toPass, true)
            ));
            $this->load->view("home_logged", $toPass);
        }else{
            $this->header_view("Home");
            $this->load->view("home_unlogged");
        }
        $this->footer_view();
    }
    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function index(){
        $this->home_view();
    }
}   