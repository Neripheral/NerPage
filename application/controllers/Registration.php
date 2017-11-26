<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Registration extends Head_Controller{
    public function index(){
        $this->load->helper("form");
        $this->viewHeader("Sign Up");
        $this->load->view("registration");
        $this->viewFooter();
    }
    
    public function register(){
        //@todo hashing passwords
        //$password = $this->ci->hash($password);
        //@idea validation of input data
        $this->load->model("Users_model");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $email = $this->input->post("email");
        $permissions = "guest";
        $this->Users_model->insert($username, $password, $email, $permissions);
        //@idea redirect to login page
        redirect("home");
    }
}