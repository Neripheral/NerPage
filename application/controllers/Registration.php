<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Registration extends Head_Controller{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------INPUT_FETCH-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function fetchInput_register(){
        $wantedFields = array("username", "password", "email");
        $toReturn = $this->fetchInput($wantedFields);
        return $toReturn;
    }
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function register(){
        //@todo hashing passwords
        //$password = $this->ci->hash($password);
        //@idea validation of input data
        $insertData = $this->fetchInput_register();
        $insertData["permissions"] = "guest";
        
        $this->load->model("Users_model");
        //FIXME change insert method in users_model to receive an array of data
        $this->Users_model->insert($insertData);
        redirect("signing");
    }
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function register_view(){
        $this->load->helper("form");
        $this->header_view("Register");
        $this->load->view("registration");
        $this->footer_view();
    }
    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function index(){
        $this->register_view();
    }
    
    
}