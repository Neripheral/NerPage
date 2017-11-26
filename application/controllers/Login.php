<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Login extends Head_Controller{
    public function index(){
        $this->load->helper("url");
        $this->load->helper("form");
        $this->viewHeader("Register");
        $this->load->view("login");        
        $this->viewFooter();
    }
}