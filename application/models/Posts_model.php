<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");

class Posts_model extends Head_model{
    public function getQuery_select($columns, $obj, $dbTable){
        $query = parent::getQuery_select($columns, $obj, $dbTable);
    }
    
    
    public function get($count){
        $query = $this->getQuery_select();
        
    }
}