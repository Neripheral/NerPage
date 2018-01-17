<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class TableModel{
    public function getAsArray(){}
    public function getAsArray_insert(){return $this->getAsArray();}
    public function getAsArray_update(){return $this->getAsArray();}
    public function getAsArray_delete(){return $this->getAsArray();}
    public function getAsArray_select(){return $this->getAsArray();}
    
    public function setAll($values){
        foreach($values as $key => $value){
            $funcName = "set".ucfirst($key);
            if(method_exists($this, $funcName))
                call_user_func(array($this, $funcName), $value);
        }
    }
}