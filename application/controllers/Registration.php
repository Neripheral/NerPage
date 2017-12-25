<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Registration extends Head_Controller{
/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function registerInDatabase($user){
        $returnValue = $this->Users_model->insert($user);
        if($returnValue === true)
            return true;
        switch($returnValue["code"]){
            case "23000/1062":
                if(preg_match("/key 'username'/", $returnValue["message"]))
                    throw new DBException("The specified username was taken.");
                elseif(preg_match("/key 'email'/", $returnValue["message"]))
                    throw new DBException("The specified email already has been used.");
            default:
                throw new DBException($returnValue["message"]);
        }
    }
    
    private function validateUserData($userData){
        if($userData["username"] == null || $userData["password"] == null || $userData["email"] == null)
            throw new InvalidArgumentException("Missing input data");
        if(!filter_var($userData["email"], FILTER_VALIDATE_EMAIL))
            throw new InvalidArgumentException("Incorrect email address");
        return true;
    }
    /* ------INPUT_FETCH-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function fetchInput_register(){
        $wantedFields = array("username", "password", "email");
        $userData = $this->fetchInput($wantedFields);
        return $userData;
    }
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function registerUserFromData($userData){
        $this->validateUserData($userData);
        $user = new User($userData["username"], $userData["password"], $userData["email"]);
        return $this->registerInDatabase($user);
    }
    
    
    public function registerUserFromForm(){
        $userData = $this->fetchInput_register();
        try{
            $this->registerUserFromData($userData);
        }catch(DBException $e){
            $this->session->set_flashdata("error", $e->getMessage());
            redirect("registration");
        }catch(InvalidArgumentException $e){
            $this->session->set_flashdata("error", $e->getMessage());
            redirect("registration");
        }
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
    
    public function __construct(){
        parent::__construct();
        $this->load->model("Users_model", "Users_model");
    }
}