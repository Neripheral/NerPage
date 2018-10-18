<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('TableModel.php');

class PanelTableColumn extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    private $id;
    private $panelId;
    private $title;
    private $dataType;

/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    
    public function getId(){
        return $this->id;
    }
    
    public function getPanelId(){
        return $this->panelId;
    }
    
    public function getTitle(){
        return $this->title;
    }
    
    public function getDataType(){
        return $this->dataType;
    }
    
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function setPanelId($panelId){
        $this->panelId = $panelId;
        return $this;
    }
    
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    public function setDataType($dataType){
        $this->dataType = $dataType;
        return $this;
    }
    
/* ------TABLEMODEL-EXTENSION----------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

    public function getAsArray(){
        $data = array(
            'id' => $this->getId(),
            'panelId' => $this->getPanelId(),
            'title' => $this-> getTitle(),
            'dataType' => $this->getDataType()
        );
        foreach($data as $key => $value)
            if($value === null)
                unset($data[$key]);
        return $data;
    }
    
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    public function __construct($columnData){
        $this->initializeAll();
        $this->setAll($columnData);
    }
}