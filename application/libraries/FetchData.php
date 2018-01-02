<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class FetchData{
    private $ci;
    
    public function fetchInput($wantedFields){
        $toReturn = array();
        foreach($wantedFields as $field)
            $toReturn[$field] = $this->ci->input->post($field);
        return $toReturn;
    }
    
    public function __construct(){
        $this->ci = &get_instance();
    }
}