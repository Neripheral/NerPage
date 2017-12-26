<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
require_once("HashedPassword.php");

class User{
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
    
    public function getPassword(){
        return $this->password->getPassword();
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
    
    
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    
    
    public function setPermissions($permissions){
        $this->permissions = $permissions;
        return $this;
    }
/* ------PRIVATE-METHODS---------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function setHashedPassword($password){
        $this->password->setHashedPassword($password);
        return $this;
    }
    
    private function setAndHashPassword($password){
        $this->password->setNormalPassword($password);
        $this->password->hashStoredPassword();
        return $this;
    }
/* ------PUBLIC-METHODS----------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    public function getAsArray(){
        return array(
            "id" => $this->getId(),
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "email" => $this->getEmail(),
            "permissions" => $this->getPermissions()
        );
    }
    
    
    public function equalToPassword($password){
        return $this->password->equalTo($password);
    }
    
    
    public function initializeAll($username, $password, $email, $permission, $id){
        $this->setId($id);
        $this->setUsername($username);
        $this->password = new HashedPassword();
        if(preg_match('/^\$2y\$10\$.*$/', $password))
            $this->setHashedPassword($password);
        else
            $this->setAndHashPassword($password);
        $this->setEmail($email);
        $this->setPermissions($permission);
    }
    
    
    public function __construct($username, $password, $email, $permission = "guest", $id = null){
        $this->initializeAll($username, $password, $email, $permission, $id);
    }
}
    

