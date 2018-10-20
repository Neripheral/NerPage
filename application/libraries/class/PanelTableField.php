<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('TableModel.php');

class PanelTableField extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    private $panelId;
    private $columnId;
    private $id;
    private $data;
    
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    public function getPanelId(){
        return $this->panelId;
    }
    
    public function getColumnId(){
        return $this->columnId;
    }
    
    public function getId(){
        return $this->id;
    }
    
    
    public function getData(){
        return $this->data;
    }
    
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    public function setPanelId($panelId){
        $this->panelId = $panelId;
        return $this;
    }
    
    public function setColumnId($columnId){
        $this->columnId = $columnId;
        return $this;
    }
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function setData($data){
        $this->data = $data;
        return $this;
    }
    
/* ------TABLEMODEL-EXTENSION----------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function getAsArray(){
        $data = array(
            'panelId' => $this->getPanelId(),
            'columnId' => $this->getColumnId(),
            'id' => $this->getId(),
            'data' => $this->getData()
        );
        foreach($data as $key => $value)
            if($value === null)
                unset($data[$key]);
        return $data;
    }
    
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function __construct($fieldData = null){
        $this->initializeAll();
        if($fieldData !== null)
            $this->setAll($fieldData);
    }
    
}