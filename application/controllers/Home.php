<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Home extends Head{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function home_logged_view(){
        $codeToLoad = array("js" => array(base_url("js/chatController.js")));
        
        $this->load->library("chat");
        $toPass = array("fromController" => array(
            "chat" => $this->chat->get_chat_view()
        ));
        $content = $this->load->view("home_logged", $toPass, true);
        $this->codebuilder->show(
                $this->codebuilder->wrap_html(
                    $content, 
                    "navtab_home",
                    $codeToLoad
            )
        );
    }
    
    public function home_unlogged_view(){
        $content = $this->load->view("home_unlogged", null, true);
        $this->codebuilder->show(
            $this->codebuilder->wrap_html(
                $content, 
                "navtab_home"
            )
        );
        
    }
    
    public function home_view(){
        $codeToLoad = array();
        $content = "";
        if($this->usermanager->userIsLogged())
            $this->home_logged_view();
        else
            $this->home_unlogged_view();
    }
    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function index(){
        $this->home_view();
    }
}   