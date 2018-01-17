<?php

class Chat_test extends TestCase{
    private static function resetDatabase(&$ci){
        $ci->db->truncate("Users");
        $data = array(
            "username" => "test_username",
            "password" => '$2y$10$cR7qHI88s9kOE2vazMACV.yeFrm6E1eioWkxcuKPvllVEKdxNMVZi',
            "email" => "test_email@example.com",
            "permissions" => "guest"
        );
        $ci->db->insert("Users", $data);
        
        $ci->db->truncate("ChatMessages");
        $data = array(
            "userId" => 1,
            "content" => 'test message'
        );
        $ci->db->insert("ChatMessages", $data);
    }
    
    public static function setUpBeforeClass(){
        $ci = &get_instance();
        $ci->db->close();
        $ci->load->database("testing");
        self::resetDatabase($ci);
    }
    
    public function setUp(){
        $this->request->setCallable(
            function($ci){
                $ci->db->close();
                $ci->load->database("testing");
            }
        );
    }
    
    public function test_chatViewCorrectlyReturned(){
        $ci = &get_instance();
        $ci->load->library("chat");
        $chatView = $ci->chat->get_chat_section();
        $this->assertContains("section_chat", $chatView);
    }
    
    public function test_chatMessagesCorrectlyShown(){
        $ci = &get_instance();
        $ci->load->library("chat");
        $chatView = $ci->chat->get_chat_section();
        $this->assertContains("test message", $chatView);
    }
    
    public function test_sendingMessagesWorks(){
        $ci = &get_instance();
        $ci->load->library("chat");
        $ci->chat->sendMessage(1, "new sent message");
        $chatView = $ci->chat->get_chat_section();
        $this->assertContains("new sent message", $chatView);
        $this->assertContains("test message", $chatView);
    }
    
    public function test_displayingTwoMessagesInsteadOfOne(){
        $ci = &get_instance();
        $ci->load->library("chat");
        $chatView = $ci->chat->get_chat_section();
        $this->assertContains("new sent message", $chatView);
        $this->assertContains("test message", $chatView);
    }
    
    public function test_ajaxMessagesReceiving(){
        $ci = &get_instance();
        $ci->load->library("chat");
        $chatView = $ci->chat->ajaxGetMessages();
        $jsonContent = '[{"id":"2","username":"test_username","content":"new sent message"},{"id":"1","username":"test_username","content":"test message"}]';
        $this->AssertEquals($jsonContent, $chatView);
    }
}