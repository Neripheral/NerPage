<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DBException extends Exception{}

class Head_model extends CI_Model{
    protected function getQuery_insert($obj, $dbTable){
        return $this->db->set($obj->getAsArray_insert())->get_compiled_insert($dbTable);
    }
    
    protected function getQuery_delete($obj, $dbTable){
        return $this->db->get_compiled_delete($dbTable, $obj->getAsArray_delete());
    }
    
    protected function getQuery_update($obj, $dbTable){
        return $this->db->get_compiled_update($dbTable, $obj->getAsArray_update());
    }
    
    protected function getQuery_select($columns, $obj, $dbTable = null){
        if($dbTable === null)
            return false;
        
        if($columns != NULL)
            $this->db->select(implode(",", $columns));
            $this->db->where($obj->getAsArray_select());
            return $this->db->get_compiled_select($dbTable);
    }
}

/* --------PRIVATE--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------OTHERS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
/* --------PUBLIC---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    /* ------QUERIES------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ */

    /* ------SELECT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------UPDATE------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */
    
    /* ------INSERT------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- */

