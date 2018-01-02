<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CodeBuilder{
    private $ci;
    
    private function getNavTabs_logged(){
        return array(
            array("text" => "Home", "id" => "navtab_home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""),
            array("text" => $this->ci->session->loggedUser->getUsername(), "id" => "navtab_account", "href" => base_url("index.php/account"), "class" => "", "icon" => "octicon octicon-person"),
            array("text" => "Sign Out", "id" => "navtab_signout", "href" => base_url("index.php/signing/signout"), "class" => "", "icon" => "octicon octicon-link-external")
        );
    }
    
    private function getNavTabs_unlogged(){
        return array(
            array("text" => "Home", "id" => "navtab_home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""),
            array("text" => "Register", "id" => "navtab_register", "href" => base_url("index.php/registration"), "class" => "", "icon" => "octicon octicon-clippy"),
            array("text" => "Sign In", "id" => "navtab_signin", "href" => base_url("index.php/signing"), "class" => "", "icon" => "octicon octicon-link-external")
        );
    }
    
    private function getHtml_header($activeTab, $codeToLoad = array()){
        $toPass = array("fromController" => $codeToLoad);
        $toPass["fromController"]["NAVBAR"] = array();
        
        if($this->ci->usermanager->userIsLogged()){ //logged
            $toPass["fromController"]["NAVBAR"] = $this->getNavTabs_logged();
        }else{ //unlogged
            $toPass["fromController"]["NAVBAR"] = $this->getNavTabs_unlogged();
        }
        
        foreach($toPass["fromController"]["NAVBAR"] as &$tab){
            $tab["id"] == $activeTab AND $tab["class"] .= " active ";
        }
        return $this->ci->load->view("common/header", $toPass, true);
    }
    
    private function getHtml_footer(){
        return $this->ci->load->view("common/footer", null, true);
    }
    
    public function show($code){
        echo $code;
    }
    
    public function wrap_html($code, $activeTab, $codeToLoad = array()){
        $header = $this->getHtml_header($activeTab, $codeToLoad);
        $footer = $this->getHtml_footer();
        return $header.$code.$footer;
    }
    
    public function __construct(){
        $this->ci = &get_instance();
    }
}