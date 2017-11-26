<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."third_party/smarty/Smarty.class.php";

/*
 * Main controller overlapping every personal controller.
 * It accumulates all repeating functions.
 */
class Head_Controller extends CI_Controller{
    protected function viewHeader($activeTab){
        $toPass = array("fromController" => array("NAVBAR" => array()));
        
        array_push($toPass["fromController"]["NAVBAR"], array("text" => "Home", "href" => base_url("index.php/home"), "class" => "", "icon" => ""));

        //@todo checking if user is logged or not
        if(false){ //logged
            //@todo what to do if user is logged
        }else{ //unlogged
            array_push($toPass["fromController"]["NAVBAR"], array("text" => "Sign Up", "href" => base_url("index.php/registration"), "class" => "", "icon" => "octicon octicon-clippy"));
            array_push($toPass["fromController"]["NAVBAR"], array("text" => "Log In", "href" => base_url("index.php/login"), "class" => "", "icon" => "octicon octicon-link-external"));
        }
        
        foreach($toPass["fromController"]["NAVBAR"] as &$tab){
            $tab["text"] == $activeTab AND $tab["class"] .= " active ";
        }
        $this->load->view("common/header", $toPass);
    }
    
    protected function viewFooter(){
        $this->load->view("common/footer");
    }
    
    public function test(){
    }
}