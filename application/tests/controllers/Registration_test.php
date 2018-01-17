<?php
class Registration_test extends TestCase{
    public $postData;
    
    private static function resetDatabase(&$ci){
        $ci->db->truncate("Users");
        $data = array(
            "username" => "taken_username",
            "password" => "password",
            "email" => "taken_email",
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
            "password" => "test_password",
            "email" => "test_email@example.com"
        );
        
        $this->request->setCallable(
            function($ci){
                $ci->db->close();
                $ci->load->database("testing");
            }
        );
    }
    
    public function test_index(){
		$output = $this->request("GET", "registration/index");
		$this->assertContains("main_register", $output);
	}
	
	public function test_registerUserFromForm_WhenEverythingCorrect(){
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);	 
	    $this->assertFalse(isset($_SESSION["error"]));
	    $this->assertRedirect("signing");
	}
	
	
	public function test_registerUserFromForm_MissingUsername(){
	    $this->postData["username"] = "";
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertTrue(isset($_SESSION["error"]));
	    $this->assertRedirect("registration");
	}
	
	
	public function test_registerUserFromForm_MissingPassword(){
	    $this->postData["password"] = "";
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertTrue(isset($_SESSION["error"]));
	    $this->assertRedirect("registration");
	}
	
	public function test_registerUserFromForm_MissingEmail(){
	    $this->postData["email"] = "";
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertTrue(isset($_SESSION["error"]));
	    $this->assertRedirect("registration");
	}
	
	public function test_registerUserFromForm_WhenEmailIsIncorrect(){
	    $this->postData["email"] = "incorrect_email";
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertTrue(isset($_SESSION["error"]));
	    $this->assertRedirect("registration");
	}
	
	public function test_registerUserFromForm_WhenUsernameWasTaken(){
	    $this->postData["username"] = "taken_username";
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertTrue(isset($_SESSION["error"]));
	    $this->assertRedirect("registration");
	}
	
	public function test_registerUserFromForm_WhenEmailWasTaken(){
	    $this->postData["email"] = "taken_email@example.com";
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertTrue(isset($_SESSION["error"]));
	    $this->assertRedirect("registration");
	}
}