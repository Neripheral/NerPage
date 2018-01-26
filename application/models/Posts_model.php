<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("Head_model.php");


class Posts_model extends Head_model{ 
    //$ratingType is a boolean type and takes _RATING_UPVOTE_ and _RATING_DOWNVOTE_ values
    public function ratePost($userId, $postId, $ratingType){
        $this->db->trans_start();
        
        $this->db->set(array("userId" => $userId, "postId" => $postId, "ratingType" => $ratingType));
        $this->db->insert("PostRating");
        $this->db->flush_cache();
        
        //UPVOTES
        $this->db->where(array("postId" => $postId, "ratingType" => _RATING_UPVOTE_));
        $upvoteCount = $this->db->count_all_results("PostRating", true);
        
        //DOWNVOTES
        $this->db->where(array("postId" => $postId, "ratingType" => _RATING_DOWNVOTE_));
        $downvoteCount = $this->db->count_all_results("PostRating", true);
        
        log_message("debug", var_export(get_defined_vars(), true));
        $totalCount = $upvoteCount - $downvoteCount;
        
        $this->db->set(array("rating" => $totalCount));
        $this->db->where("Posts.id", $postId);
        $this->db->update("Posts");
        
        $this->db->trans_complete();
        return true;
    }
    
    public function insert($postToInsert){
        $this->db->set($postToInsert->getAsArray_insert());
        $this->db->insert("Posts");
        $error = $this->db->error();
        if($error["code"] == 0)
            return true;
        return $error;
    }
    
    public function get($userId = null){
        $this->db->select(array("Posts.id", "Users.username", "Posts.title", "Posts.content", "Posts.rating", "PostRating.ratingType"));
        $this->db->from("Posts");
        $this->db->join("Users", "Posts.userId = Users.id", "left");
        $this->db->join("PostRating", "PostRating.postId = Posts.id AND PostRating.userId = Posts.userId", "left");
        $this->db->order_by("Posts.id", "DESC");
        $this->db->limit(10);
        //log_message("debug", $this->db->get_compiled_select());
        $answer = $this->db->get()->result_array();
        return $answer;
    }
}