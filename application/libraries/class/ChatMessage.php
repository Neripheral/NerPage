<?php 
defined("BASEPATH") OR exit("No direct script access allowed");

class ChatMessage{
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
    
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function getAsArray(){
        return array(
            "id" => $this->getId(),
            "userId" => $this->getUserId(),
            "content" => $this->getContent()
        );
    }
    
    
    public function initializeAll($userId, $content, $id){
        $this->setId($id);
        $this->setUserId($userId);
        $this->setContent($content);
        return $this;
    }
    
    
    public function __construct($userId, $content, $id = null){
        $this->initializeAll($id, $userId, $content);
    }
}
    