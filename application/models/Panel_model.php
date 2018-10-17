<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class Panel_model extends Head_model{
    public function getMatchingPanels($panel){
        $this->db->select(array('id', 'ownerId', 'name', 'description'));
        $this->db->from('Panels');
        $this->db->where($panel->getAsArray_select());
        $answer = $this->db->get()->result_array();
        if(empty($answer))
            return false;
        $panels = array();
        foreach($answer as $panelData){
            $panel = new Panel($panelData);
            array_push($panels, $panel);
        }
        return $panels;
    }
    
    public function insert($panelToAdd){
        $this->db->set($panelToAdd->getAsArray_insert());
        $this->db->insert("Panels");
        $error = $this->db->error();
        if($error['code'] == 0)
            return true;
        return $error;
    }
    
    /*private function getFileStorageData($panelId){
        $this->db->select(array('PanelFileStorage.id', 'PanelFileStorage.filename', 'PanelFileStorage.directory', 'PanelFileStorage.date'));
        $this->db->from('PanelFileStorage');
        $this->db->where(array('PanelFileStorage.panelId' => $panelId));
        
        $answer = $this->db->get()->result_array();
        return $answer;
    }
    

    
    public function getDetails($panelId){
        $this->db->select(array('Panels.id', "PanelTypes.name as 'panelType'", "Users.username as 'owner'", 'Panels.name', 'Panels.description'));
        $this->db->from('Panels');
        $this->db->join('Users', 'Panels.ownerId = Users.id', 'left');
        $this->db->join('PanelTypes', 'Panels.panelTypeId = PanelTypes.id', 'left');
        $this->db->where(array('Panels.id' => $panelId));
        //log_message('debug', var_export($this->db->get_compiled_select(), true));
        $answer = $this->db->get()->result_array();
        if(!isset($answer[0]))
            return false;
        $toReturn = $answer[0];
        $toReturn['DATA'] = array();
        
        switch($toReturn['panelType']){
            case 'FileStorage':
                $toReturn['DATA'] = $this->getFileStorageData($panelId);
                break;
            default:
                $toReturn['DATA'] = null;
        }
        
        
        return $toReturn;
    }
    
    
    
    public function getList($userId){
        $this->db->select(array("Panels.id", 'Panels.name', 'Panels.description'));
        $this->db->from("Panels");
        $this->db->where(array('Panels.ownerId' => $userId));
        //log_message('debug', $this->db->get_compiled_select());
        $answer = $this->db->get()->result_array();
        return $answer;
    }*/
}
/*
    select Panels.id, PanelTypes.name as 'panelType', Users.username as 'owner', Panels.name, Panels.description
    from Panels
    left join Users on Panels.ownerId = Users.id
    left join PanelTypes on Panels.panelTypeId = PanelTypes.id
    where Panels.id = 1
*/