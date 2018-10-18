<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class PanelTable_model extends Head_model{
    public function insert_column($column){
        $this->db->select('id');
        $this->db->from('PanelTable_Columns');
        $this->db->where(array('panelId' => $column->getPanelId()));
        $id = $this->db->count_all_results();
        $column->setId($id);
        
        $this->db->set($column->getAsArray_insert());
        $error = $this->db->insert('PanelTable_Columns');
        if($error["code"] == 0)
            return true;
        return $error;
    }
    
    public function insert_field($field){
        $this->db->select('id');
        $this->db->from('PanelTable_Data');
        $this->db->where(array('panelId' => $field->getPanelId(), 'columnId' => $field->getColumnId()));
        $id = $this->db->count_all_results();
        $field->setId($id);
        
        $this->db->set($field->getAsArray_insert());
        $error = $this->db->insert('PanelTable_Data');
        if($error["code"] == 0)
            return true;
        return $error;
    }
}
    
/*
select 
    
    
*/