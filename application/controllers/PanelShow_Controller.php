<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Head.php";
require_once APPPATH.'libraries/class/PanelTableColumn.php';
require_once APPPATH.'libraries/class/PanelTableField.php';

class PanelShow_Controller extends Head{
    public function addColumn($panelId, $title, $dataType){
        $data = array('panelId' => $panelId, 'title' => $title, 'dataType' => $dataType);
        /*...*/
        $column = new PanelTableColumn($data);
        $this->load->model('PanelTable_model');
        $this->PanelTable_model->insert_column($column);
    }
    
    public function addField($panelId, $columnId, $data){
        $data = array('panelId' => $panelId, 'columnId' => $columnId, 'data' => $data);
        /*...*/
        $field = new PanelTableField($data);
        $this->load->model('PanelTable_model');
        $this->PanelTable_model->insert_field($field);
    }
    
    public function view($panelId){
        $this->showPanel_view($panelId);
    }
    
    public function index(){
        $this->showpanel_view($panelId);
    }
}