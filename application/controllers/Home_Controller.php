<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Home_Controller extends Head{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function home_logged_view(){
        $this->load->library("chat");
        
        $content = $this->chat->get_chat_section();
        $this->codebuilder->setKeyword("home_logged")
                            ->appendCode($content)
                            ->add_head(base_url("js/chatController.js"))
                            ->wrap_all()
                            ->show();
    }
    
    public function home_unlogged_view(){
        $this->codebuilder->setKeyword("home_unlogged")
                            ->append_section("home_unlogged")
                            ->wrap_all()
                            ->show();
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