<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Head.php";
require_once APPPATH.'libraries/class/PanelTableColumn.php';
require_once APPPATH.'libraries/class/PanelTableField.php';

class PanelShow_Controller extends Head{
    private function fetchInput_newRow(){
        $pattern = '/^inputColumn_([0-9]+)/';
        $data = array();
        $data['rowData'] = $this->fetchdata->fetchInputRegex($pattern);
        $data['panelId'] = $this->fetchdata->fetchInput('panelId');
        return $data;
    }
    
    public function panelTable_view($panelId){
        $this->load->helper('form');
        
        $this->load->model('panelTable_model');
        $panel = $this->panelTable_model->getPanelTable($panelId);
        
        $dataToPass = array();
        $dataToPass['TABLEDATA'] = $panel->getAsArray(); 
        $dataToPass['PANELDATA']['panelId'] = $panelId;
        
        $this->codebuilder->setKeyword('panelTable')
                            ->append_section(array('panelShow_table', $dataToPass))
                            ->wrap_all()
                            ->show();
    }
    
    public function addColumn($panelId, $title, $dataType){
        $data = array('panelId' => $panelId, 'title' => $title, 'dataType' => $dataType);
        /*...*/
        $column = new PanelTableColumn($data);
        $this->load->model('PanelTable_model');
        $this->PanelTable_model->insert_column($column);
    }
    
    public function addRow(){
        $data = $this->fetchInput_newRow();
        $newRow = array();
        foreach($data['rowData'] as $columnId => $fieldData){
            $newField = new PanelTableField();
            $newField->setColumnId($columnId);
            $newField->setData($fieldData);
            $newField->setPanelId($data['panelId']);
            array_push($newRow, $newField);
        }
        $this->load->model('PanelTable_model');
        $this->PanelTable_model->insert_row($newRow);
        redirect('panelShow/panel_show/'.$data['panelId']);
    }
    
    public function panel_show($panelId){
        $this->panelTable_view($panelId);
    }
    
    public function index(){
        $this->showpanel_view($panelId);
    }
}