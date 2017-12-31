<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Chat.php");

class Home extends Chat{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function home_view(){
        $codeToLoad = array();
        $content = "";
        if($this->userIsLogged()){
            $codeToLoad = array("js" => array(base_url("js/chatController.js")));
            $toPassChat = array("fromController" => array(
                "MESSAGES" => $this->getMessages(0)
            ));
            $toPass = array("fromController" => array(
                "chat" => $this->load->view("chat", $toPassChat, true)
            ));
            $content = $this->load->view("home_logged", $toPass, true);
        }else{
            $content = $this->load->view("home_unlogged", null, true);
        }
        
        $this->show($this->wrap_html($content, "navtab_home", $codeToLoad));
    }
    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function index(){
        $this->home_view();
    }
}   