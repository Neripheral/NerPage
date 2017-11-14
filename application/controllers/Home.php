<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Home extends Head_Controller{
    public function index(){
        $this->load->helper("url");
        $this->load->view("common/header");
        $this->load->view("home");
        $this->load->view("common/footer");
    }
}