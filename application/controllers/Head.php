<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."libraries/class/User.php";
require_once APPPATH.'libraries/class/Panel.php';
require_once APPPATH."third_party/smarty/Smarty.class.php";

/*
 * Main controller overlapping every personal controller.
 * It accumulates all repeating functions.
 */
class Head extends CI_Controller{
    protected function setError($errorMessage){
        $this->session->set_flashdata("error", $errorMessage);
        return true;
    }
}

