<?php
defined("BASEPATH") OR exit('No direct script access allowed');
require_once('TableModel.php');

class Panel extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private $id;
    private $ownerId;
    private $name;
    private $description;
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getId(){
        return $this->id;
    }

    public function getOwnerId(){
        return $this->ownerId;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function setOwnerId($ownerId){
        $this->ownerId = $ownerId;
        return $this;
    }
    
    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function setDescription($description){
        $this->description = $description;
    }
/* ------TABLEMODEL-OVERLOADING--------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function getAsArray(){
        $data = array(
            'id' => $this->getId(),
            'ownerId' => $this->getOwnerId(),
            'name' => $this->getName(),
            'description' => $this->getDescription()
        );
        foreach($data as $key => $value)
            if($value === null)
                unset($data[$key]);
        
        return $data;
    }
    
    public function getAsArray_insert(){
        $data = $this->getAsArray();
        unset($data['id']);
        return $data;
    }
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function initializeAll(){
        $this->setId(null);
        $this->setOwnerId(null);
        $this->setName(null);
        $this->setDescription(null);
        return $this;
    }
    
    public function __construct($panelData){
        $this->initializeAll();
        $this->setAll($panelData);
    }
    
    
}
