<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Head_model.php" ;
require_once APPPATH.'libraries/class/PanelTable.php';

class PanelTable_model extends Head_model{
    public function getPanelFields($panelId, $limit = 100, $offset = 0){
        $this->db->select(array('columnId', 'id', 'data'));
        $this->db->from('PanelTable_Data');
        $this->db->order_by('id', 'columnId');
        $this->db->where(array('panelId' => $panelId, 'status' => 'enabled'));
        $answer = $this->db->get()->result_array();
        return $answer;
    }
    
    public function getPanelColumns($panelId){
        $this->db->select(array('id', 'title', 'dataType'));
        $this->db->from('PanelTable_Columns');
        $this->db->order_by('id');
        $this->db->where(array('panelId' => $panelId, 'status' => 'enabled'));
        $answer = $this->db->get()->result_array();
        return $answer;
    }
    
    public function getPanelTable($panelId){
        $columnsData = $this->getPanelColumns($panelId);
        $rowsData = $this->getPanelFields($panelId);
        $panel = new PanelTable($columnsData, $rowsData);
        return $panel;
    }
    
    public function insert_column($column){
        $this->db->select_max('id');
        $this->db->from('PanelTable_Columns');
        $this->db->where(array('panelId' => $column->getPanelId()));
        $id = $this->db->get()->result_array()[0]['id'];
        log_message('debug', var_export($id,true));
        if($id === null)
            $id = 0;
        else
            $id++;
        $column->setId($id);
        $this->db->set($column->getAsArray_insert());
        $error = $this->db->insert('PanelTable_Columns');
        if($error["code"] == 0)
            return true;
        return $error;
    }
    
    public function insert_row($rowRaw){
        $this->db->trans_start();
        $this->db->select_max('id');
        $this->db->from('PanelTable_Data');
        log_message('debug', var_export($rowRaw, true));
        $this->db->where(array('panelId' => $rowRaw[0]->getPanelId(), 'columnId' => $rowRaw[0]->getColumnId()));
        $id = $this->db->get()->result_array()[0]['id'];
        if($id === null)
            $id = 0;
        else
            $id++;
        
        $row = array();
        foreach($rowRaw as $value){
            $value->setId($id);
            array_push($row, $value->getAsArray());
        }
        
        //$this->db->set($field->getAsArray_insert());
        $error = $this->db->insert_batch('PanelTable_Data', $row);
        $this->db->trans_complete();
        if($error["code"] == 0)
            return true;
        return $error;
    }
}
    
/*
select 
    
    
*/