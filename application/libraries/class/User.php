<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
require_once("TableModel.php");
require_once("HashedPassword.php");

class User extends TableModel{
/* ------PROPERTIES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    private $id;
    private $username;
    private $password;
    private $email;
    private $permissions;
/* ------GETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function getId(){
        return $this->id;
    }
    
    
    public function getUsername(){
        return $this->username;
    }
    
    
    private function getPasswordEx(){
        return $this->password;
    }
 
    
    public function getPassword(){
        return $this->getPasswordEx()->getPassword();
    }
    
    
    public function getEmail(){
        return $this->email;
    }
    
    
    public function getPermissions(){
        return $this->permissions;
    }
/* ------SETTERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    
    public function setUsername($username){
        $this->username = $username;
        return $this;
    }
    
    
    private function setPasswordEx($hashedPassword){
        $this->password = $hashedPassword;
    }
    
    
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    
    
    public function setPermissions($permissions){
        $this->permissions = $permissions;
        return $this;
    }
    /* ------EXTENDED-SETTERS--------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function setHashedPassword($passwordToSet){
        $password = $this->getPasswordEx();
        $password->setHashedPassword($passwordToSet);
        $this->setPasswordEx($password);
        return $this;
    }
    
    
    private function setAndHashPassword($passwordToSet){
        $password = $this->getPasswordEx();
        $password->setNormalPassword($passwordToSet);
        $password->hashStoredPassword();
        $this->setPasswordEx($password);
        return $this;
    }
    
    
    public function setPassword($password){
        if(preg_match('/^\$2y\$10\$.*$/', $password))
            $this->setHashedPassword($password);
        else
            $this->setAndHashPassword($password);
        return $this;
    }
/* ------TABLEMODEL-OVERLOADING--------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function getAsArray(){
        $data = array(
            "id" => $this->getId(),
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "email" => $this->getEmail(),
            "permissions" => $this->getPermissions()
        );
        foreach($data as $key => $value)
            if($value === null)
                unset($data[$key]);
        
        return $data;            
    }
    
    
    public function getAsArray_insert(){
        $data = $this->getAsArray();
        unset($data["id"]);
        return $data;
    }
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function equalToPassword($password){
        return $this->getPasswordEx()->equalTo($password);
    }
    

    public function initializeAll(){
        $this->setId(null);
        $this->setUsername(null);
        $this->setPasswordEx(new HashedPassword());
        $this->setEmail(null);
        $this->setPermissions(null);
    }
    
    
    public function __construct($userData){
        $this->initializeAll();
        $this->setAll($userData);
    }
}
    

