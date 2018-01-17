<?php 
defined("BASEPATH") OR exit("No direct script access allowed");

class ChatMessage extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private $id;
    private $userId;
    private $content;
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getId(){
        return $this->id;
    }
    
    
    public function getUserId(){
        return $this->userId;
    }
    
    
    public function getContent(){
        return $this->content;
    }
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    
    public function setUserId($userId){
        $this->userId = $userId;
        return $this;
    }
    
    
    public function setContent($content){
        $this->content = $content;
        return $this;
    }
/* ------PRIVATE-METHODS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
/* ------TABLEMODEL-OVERLOADING--------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function getAsArray(){
        return array(
            "id" => $this->getId(),
            "userId" => $this->getUserId(),
            "content" => $this->getContent()
        );
    }
    
    
    public function getAsArray_insert(){
        $data = $this->getAsArray();
        unset($data["id"]);
        return $data;
    }
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function initializeAll(){
        $this->setId(null);
        $this->setUserId(null);
        $this->setContent(null);
        return $this;
    }
    
    
    public function __construct($msgData){
        $this->initializeAll();
        $this->setAll($msgData);
    }
}
    