<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_Library.php");

class FetchData extends Head_Library{
    public function fetchInputRegex($pattern){
        $data = $this->ci->input->post();
        $toReturn = array();
        foreach($data as $key => $value){
            $match = array();
            preg_match($pattern, $key, $match);
            if(!empty($match))
                $toReturn[$match[1]] = $value;
            
        }
        return $toReturn;
    }
    
    public function fetchInput($wantedFields){
        if(!is_array($wantedFields))
            return $this->ci->input->post($wantedFields);
        $toReturn = array();
        foreach($wantedFields as $field)
            $toReturn[$field] = $this->ci->input->post($field);
        return $toReturn;
    }
}