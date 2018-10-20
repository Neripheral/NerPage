<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head.php");

// Alter anything your soul and heart desired. 
// The front of imagination and the war with bugs...
require_once APPPATH.'libraries/class/PanelTable.php';
class Testing_Controller extends Head{
    public function index(){
        $this->load->model("PanelTable_model");
        $data = $this->PanelTable_model->getPanelFields(0);
        $test = new PanelTable();
        $test->setRowsFromData($data);
        var_dump($test);
    }
}