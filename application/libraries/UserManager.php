<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserManager{
    private $ci;
    
    public function userIsLogged(){
        return isset($this->ci->session->loggedUser);
    }
    
    public function signUserIn($user){
        $this->ci->session->set_userdata(array("loggedUser" => $user));
    }
    
    public function signUserOut(){
        $this->ci->session->unset_userdata("loggedUser");
    }
    
    public function getLoggedUser(){
        if($this->userIsLogged())
            return $this->ci->session->loggedUser;
        else
            return false;
    }
    
    
    public function __construct(){
        $this->ci = &get_instance();
    }
}