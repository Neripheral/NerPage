<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/class/Post.php");
require_once("Head_Library.php");

class Newsfeed extends Head_Library{
    public function ratePost($userId, $postId, $ratingType){
        $this->ci->load->model("Posts_model");
        return $this->ci->Posts_model->ratePost($userId, $postId, $ratingType);
    }
    
    public function upvote($userId, $postId){
        return $this->ratePost($userId, $postId, _RATING_UPVOTE_);
    }
    
    public function downvote($userId, $postId){
        return $this->ratePost($userId, $postId, _RATING_DOWNVOTE_);
    }
    
    public function addPost($postData){
        $this->ci->load->model("Posts_model");
        $post = new Post($postData);
        return $this->ci->Posts_model->insert($post);
    }
    
    private function getPosts(){
        $this->ci->load->model("Posts_model");
        return $this->ci->Posts_model->get();
    }
    
    public function get_newsfeed_section($userId = null){
        $postsData = $this->getPosts($userId);
        foreach($postsData as &$post){
            $post["upvote"] = "";
            $post["downvote"] = "";
            if($post["ratingType"] == _RATING_UPVOTE_)
                $post["upvote"] = "activated";
            elseif($post["ratingType"] == _RATING_DOWNVOTE_)
                $post["downvote"] = "activated";
            unset($post["ratingType"]);
        }
        $toPass = array(
            "POSTS" => $postsData
        );
        return $this->ci->codebuilder->prepareSection(array("newsfeed", $toPass), "newsfeed");
    }
}