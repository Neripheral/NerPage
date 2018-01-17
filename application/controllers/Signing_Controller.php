<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Signing_Controller extends Head{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    // Flags session as logged and inserts user's data
    private function logIn($data){
        //Select only the desired data
        $this->usermanager->signUserIn($data);
        return true;
    }
    /* ------INPUT_FETCH-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function fetchInput_signIn(){
        $wantedFields = array("username", "password");
        $toReturn = $this->fetchdata->fetchInput($wantedFields);
        return $toReturn;
    }
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function signOut(){
        $this->usermanager->signUserOut();
        redirect("signing");
    }
    
    
    public function logByForm(){
        $input = $userData = $this->fetchInput_signIn();
        unset($userData["password"]);
        $user = new User($userData);
        $this->load->model("Users_model");
        $user = $this->Users_model->getMatchingUser($user);
        if($user == NULL){
            $this->session->set_flashdata("error", "Specified user doesn't exist");
            redirect("signing");
        }
        if(!$user->equalToPassword($input["password"])){
            $this->session->set_flashdata("error", "Incorrect password");
            redirect("signing");
        }
        $this->logIn($user);
        redirect("home");
    }
    /* ------VIEW--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function signIn_view(){
        $this->load->helper("form");
        
        $this->codebuilder->setKeyword("signin")
                            ->append_section("signin")
                            ->wrap_all()
                            ->show();
    }
    /* ------INDEX-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function index(){
        $this->signIn_view();
    }
}