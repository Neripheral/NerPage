<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."third_party/smarty/Smarty.class.php";
require_once APPPATH."libraries/class/User.php";

/*
 * Main controller overlapping every personal controller.
 * It accumulates all repeating functions.
 */
class Head_Controller extends CI_Controller{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PROTECTED------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ----<<<-USER-MANIPULATION->>>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */    
    
    
    
    protected function userIsLogged(){
        return isset($this->session->loggedUser);
    }
    
    protected function setLoggedUser($user){
        $this->session->set_userdata(array("loggedUser" => $user));
    }
    
    protected function getLoggedUser(){
        if($this->userIsLogged())
            return $this->session->loggedUser;
        else 
            return false;
    }
   
    
   
    /* ----<<<-USER-MANIPULATION->>>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ----<<<-OTHERS->>>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
   
    
    
    protected function fetchInput($wantedFields){
        $toReturn = array();
        foreach($wantedFields as $field)
            $toReturn[$field] = $this->input->post($field);
        return $toReturn;
    }
   
    protected function show($code){
        echo $code;
    }
    
    
   
    /* ----<<<-OTHERS->>>------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    /* ----<<<-WRAPPERS->>>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
   
    
    
    private function getNavTabs_logged(){
        return array(
            array("text" => "Home", "id" => "navtab_home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""),
            array("text" => $this->session->loggedUser->getUsername(), "id" => "navtab_account", "href" => base_url("index.php/account"), "class" => "", "icon" => "octicon octicon-person"),
            array("text" => "Sign Out", "href" => base_url("index.php/signing/signout"), "id" => "navtab_signout", "class" => "", "icon" => "octicon octicon-link-external")
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
        
        if($this->userIsLogged()){ //logged
            $toPass["fromController"]["NAVBAR"] = $this->getNavTabs_logged();
        }else{ //unlogged
            $toPass["fromController"]["NAVBAR"] = $this->getNavTabs_unlogged();
        }
        
        foreach($toPass["fromController"]["NAVBAR"] as &$tab){
            $tab["id"] == $activeTab AND $tab["class"] .= " active ";
        }
        return $this->load->view("common/header", $toPass, true);
    }
    
    private function getHtml_footer(){
        return $this->load->view("common/footer", null, true);
    }
    
    protected function wrap_html($code, $activeTab, $codeToLoad = array()){
        $header = $this->getHtml_header($activeTab, $codeToLoad);
        $footer = $this->getHtml_footer();
        return $header.$code.$footer;
    }
    
    
    
    /* ----<<<-WRAPPERS->>>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /*
     * $activeTab - string containg name of the selected tab
     */
    
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
}







/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

    /* ------INPUT_FETCH-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

