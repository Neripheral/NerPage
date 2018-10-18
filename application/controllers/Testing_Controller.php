<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

// Alter anything your soul and heart desired. 
// The front of imagination and the war with bugs...

class Testing_Controller extends Head{
    public function index(){
        $this->load->model("PanelTable_model");
        $this->PanelTable_model->insert_column(1,'');
    }
}