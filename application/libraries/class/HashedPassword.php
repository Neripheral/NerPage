<?php
defined("BASEPATH") OR exit("No direct script access allowed");

/*
 * The main reason why this class exists is to ease working with passwords and hashed passwords. 
 * It can store normal passwords and hashed ones.
 */
class HashedPassword{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private $password;
    private $isHashed;
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getPassword(){
        return $this->password;
    }
    
    
    public function getIsHashed(){
        return $this->isHashed;
    }
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    private function setPassword($password){
        $this->password = $password;
    }
    
    
    private function setIsHashed($isHashed){
        $this->isHashed = $isHashed;
    }
/* ------PRIVATE-METHODS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private function hashGivenPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function setHashedPassword($hashedPassword){
        $this->setPassword($hashedPassword);
        $this->setIsHashed(true);
        return $this;
    }
    
    
    public function setNormalPassword($normalPassword){
        $this->setPassword($normalPassword);
        $this->setIsHashed(false);
        return $this;
    }
    
    
    public function hashStoredPassword(){
        if(!$this->getIsHashed()){
            $this->setPassword($this->hashGivenPassword($this->getPassword()));
            $this->setIsHashed(true);
        }
        return $this;
    }
    
    
    public function equalTo($password){
        //@todo make sure that $password is the object of the HashedPassword or 
        if(!is_object($password)){
            $password = new HashedPassword($password);
        }
        
        if(!$password->getIsHashed()){   // Given password isn't hashed 
            if(!$this->getIsHashed()){       // This password isn't hashed neither
                return $password->getPassword() == $this->getPassword();
            }else{                           // This password is hashed
                return password_verify($password->getPassword(), $this->getPassword());
            }
        }else{                           // Given password is hashed
            if(!$this->getIsHashed()){       // This password isn't hashed
                return password_verify($this->getPassword(), $password->getPassword());
            }else{                           // This password is hashed
                return $password->getPassword() == $this->getPassword();
            }
        }
        return false;
    }
   
    
    public function __construct($password = null, $isHashed = false){
        $this->setPassword($password);
        $this->setIsHashed($isHashed);
    }
}

/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
/* ------PRIVATE-METHODS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */