<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."third_party/smarty/Smarty.class.php";
require_once APPPATH."libraries/User.php";

/*
 * Main controller overlapping every personal controller.
 * It accumulates all repeating functions.
 */
class Head_Controller extends CI_Controller{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

/* --------PROTECTED------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    protected function fetchInput($wantedFields){
        $toReturn = array();
        foreach($wantedFields as $field)
            $toReturn[$field] = $this->input->post($field);
        return $toReturn;
    }
    
    /*
     * $activeTab - string containg name of the selected tab
     */
    protected function header_view($activeTab){
        $toPass = array("fromController" => array("NAVBAR" => array()));
        
        array_push($toPass["fromController"]["NAVBAR"], array("text" => "Home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""));
        
        if(isset($this->session->loggedUser)){ //logged
            array_push($toPass["fromController"]["NAVBAR"], array("text" => $this->session->loggedUser->getUsername(), "href" => base_url("index.php/account"), "class" => "", "icon" => "octicon octicon-person"));
            array_push($toPass["fromController"]["NAVBAR"], array("text" => "Sign Out", "href" => base_url("index.php/signing/signout"), "class" => "", "icon" => "octicon octicon-link-external"));
        }else{ //unlogged
            array_push($toPass["fromController"]["NAVBAR"], array("text" => "Register", "href" => base_url("index.php/registration"), "class" => "", "icon" => "octicon octicon-clippy"));
            array_push($toPass["fromController"]["NAVBAR"], array("text" => "Sign In", "href" => base_url("index.php/signing"), "class" => "", "icon" => "octicon octicon-link-external"));
        }
        
        foreach($toPass["fromController"]["NAVBAR"] as &$tab){
            $tab["text"] == $activeTab AND $tab["class"] .= " active ";
        }
        $this->load->view("common/header", $toPass);
    }
    
    
    protected function footer_view(){
        $this->load->view("common/footer");
    }
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

