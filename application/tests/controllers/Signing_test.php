<?php
class Signing_test extends TestCase{
    public $postData;
    
    private static function resetDatabase(&$ci){
        fwrite(STDERR, print_r("TRUNCATING", TRUE));
        $ci->db->truncate("Users");
        $data = array(
            "username" => "test_username",
            "password" => '$2y$10$cR7qHI88s9kOE2vazMACV.yeFrm6E1eioWkxcuKPvllVEKdxNMVZi',
            "email" => "test_email@example.com",
            "permissions" => "guest"
        );
        $ci->db->insert("Users", $data);
    }
    
    public static function setUpBeforeClass(){
        $ci = &get_instance();
        $ci->db->close();
        $ci->load->database("testing");
        self::resetDatabase($ci);
    }
    
    public function setUp(){
        $this->postData = array(
            "username" => "test_username",
            "password" => "test_password"
        );
        
        $this->request->setCallable(
            function($ci){
                $ci->db->close();
                $ci->load->database("testing");
            }
        );
    }
    
    public function test_index(){
		$output = $this->request("GET", "signing/index");
		$this->assertContains("<h1>Sign In</h1>", $output);
	}
	
	public function test_logByForm_ExistingUser(){
	    $this->request("POST", "signing/logByForm", $this->postData);
	    $this->assertRedirect("home");
	}
	
	public function test_logByForm_NonExistingUsername(){
	    $this->postData["username"] = 'incorrect_username';
	    
	    $this->request("POST", "signing/logByForm", $this->postData);
	    //@todo check if error message was shown
	    $this->assertRedirect("signing");
	}
	
	public function test_logByForm_PasswordIncorrect(){
	    $this->postData["password"] = 'incorrect_password';
	    
	    $this->request("POST", "signing/logByForm", $this->postData);
	    //@todo check if error message was shown
	    $this->assertRedirect("signing");
	}
	
	public function test_logByForm_LogOut(){
	    
	}
}