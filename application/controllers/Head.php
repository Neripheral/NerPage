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
        
        array_push($toPass["fromController"]["NAVBAR"], array("text" => "Home", "href" => base_url("index.php/home"), "class" => ""));
        
        foreach($toPass["fromController"]["NAVBAR"] as &$tab){
            $tab["text"] == $activeTab AND $tab["class"] .= " active ";
        }
        $this->load->view("common/header", $toPass);
    }
    
    protected function viewFooter(){
        $this->load->view("common/footer");
    }
}