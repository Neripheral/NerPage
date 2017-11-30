<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Signing extends Head_Controller{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Flags session as logged and inserts user's data
    private function logIn($data){
        //Select only the desired data
        $partData = array(
            "userId" => $data["id"],
            "username" => $data["username"],
            "email" => $data["email"],
            "permissions" => $data["permissions"]
        );
        $this->session->set_userdata($partData);
        return true;
    }
    /* ------INPUT_FETCH-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function fetchInput_signIn(){
        $wantedFields = array("username", "password");
        $toReturn = $this->fetchInput($wantedFields);
        return $toReturn;
    }
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function logByForm(){
        $userData = $this->fetchInput_signIn();
        $this->load->model("Users_model");
        //FIXME change Users_model->getMatchingUser() to receive an array of data
        $user = $this->Users_model->getMatchingUser($userData);
        if($user == NULL)
            redirect("signing");
        $this->logIn($user);
        redirect("home");
    }
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function signIn_view(){
        $this->load->helper("form");
        $this->header_view("Sign In");
        $this->load->view("signin");
        $this->footer_view();
    }
    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function index(){
        $this->signIn_view();
    }
}