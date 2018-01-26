<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("TableModel.php");

class Post extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private $id;
    private $userId;
    private $title;
    private $content;
    private $rating;
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getId(){
        return $this->id;
    }
    
    
    public function getUserId(){
        return $this->userId;
    }

    
    public function getTitle(){
        return $this->title;
    }
    
    
    public function getContent(){
        return $this->content;
    }
    
    
    public function getRating(){
        return $this->rating;
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
    
    
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    
    public function setContent($content){
        $this->content = $content;
        return $this;
    }
    
    
    public function setRating($rating){
        $this->rating = $rating;
        return $this;
    }
/* ------TABLEMODEL-OVERLOADING--------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function getAsArray(){
        return array(
            "id" => $this->getId(),
            "userId" => $this->getUserId(),
            "title" => $this->getTitle(),
            "content" => $this->getContent(),
            "rating" => $this->getRating()
        );
    }

    
    public function getAsArray_insert(){
        $toReturn = parent::getAsArray_insert();
        unset($toReturn["id"]);
        unset($toReturn["rating"]);
        return $toReturn;
    }
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function initializeAll(){
        $this->setId(null);
        $this->setUserId(null);
        $this->setTitle(null);
        $this->setContent(null);
        $this->setRating(null);
        return $this;
    }
    
    public function __construct($postData){
        $this->initializeAll();
        $this->setAll($postData);
    }
}