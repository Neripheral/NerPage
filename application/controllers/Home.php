<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Home extends Head_Controller{
    public function index(){
        $this->viewHeader("Home");
        $this->load->view("home");
        $this->viewFooter();
    }
}