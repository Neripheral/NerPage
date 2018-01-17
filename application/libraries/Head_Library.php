<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Head_Library{
    public $ci;
    
    public function __construct(){
        $this->ci = &get_instance();
    }
}