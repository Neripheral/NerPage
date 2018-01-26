<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

class Testing_Controller extends Head{
    public function index(){
        $this->load->model("Posts_model");
        var_dump($this->Posts_model->get());
    }
}