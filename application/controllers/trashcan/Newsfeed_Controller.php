<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
require_once("Head.php");

class Newsfeed_Controller extends Head{
    public function upvotePost($postId){
        $this->load->library("newsfeed");
        echo $this->newsfeed->upvote($this->usermanager->getLoggedUser()->getId(), (int)$postId);
    }
    
    public function downvotePost($postId){
        $this->load->library("newsfeed");
        echo $this->newsfeed->downvote($this->usermanager->getLoggedUser()->getId(), (int)$postId);
    }
    
    private function fetchInput_addPost(){
        $wantedFields = array("content", "title");
        return $this->fetchdata->fetchInput($wantedFields);
    }
    
    public function addPost(){
        $this->load->library("Newsfeed");
        $data = $this->fetchInput_addPost();
        log_message("debug", var_export($data, true));
        $data["userId"] = $this->usermanager->getLoggedUser()->getId();
        $answer = $this->newsfeed->addPost($data);
        if($answer === true)
            redirect(base_url("index.php/home"));
        var_dump($answer);
    }
}