<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_Library.php");

class FetchData extends Head_Library{
    public function fetchInput($wantedFields){
        $toReturn = array();
        foreach($wantedFields as $field)
            $toReturn[$field] = $this->ci->input->post($field);
        return $toReturn;
    }
}