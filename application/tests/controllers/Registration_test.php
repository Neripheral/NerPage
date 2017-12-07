<?php
require __DIR__ . '\..\_ci_phpunit_test\patcher/bootstrap.php';
class Registration_test extends TestCase{
    public $postData;
    
    public function setUp(){
        $this->postData = array(
            "username" => "test_username",
            "password" => "test_password",
            "email" => "test_email"
        );
        
        $this->request->setCallable(
            function($ci){
                $mock = $this->createMock(Users_model::class);
                $mock->method("insert")
                     ->will($this->returnCallback(
                            function($user){
                                return true;
                            }
                         ));
                     
                $ci->Users_model = $mock;
            }
        );
	}
    
    public function test_index()
	{
		$output = $this->request("GET", "registration/index");
		$this->assertContains("<h1>Registration</h1>", $output);
	}
	
	public function test_registerUserFromFormRedirectsToSigningPage(){
	    $this->postData = array(
	        "username" => "test_username",
	        "password" => "test_password",
	        "email" => "test_email@example.com"
	    );
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);	                       
	    $this->assertRedirect("signing");
	}
	
	
	public function test_registerUserFromFormMissingUsername(){
	    $this->postData = array(
	        "username" => "",
	        "password" => "test_password",
	        "email" => "test_email"
	    );
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertRedirect("registration");
	}
	
	
	public function test_registerUserFromFormMissingPassword(){
	    $this->postData = array(
	        "username" => "test_username",
	        "password" => "",
	        "email" => "test_email"
	    );
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertRedirect("registration");
	}
	
	public function test_registerUserFromFormMissingEmail(){
	    $this->postData = array(
	        "username" => "test_username",
	        "password" => "test_password",
	        "email" => ""
	    );
	    
	    $this->request("POST", "registration/registerUserFromForm", $this->postData);
	    $this->assertRedirect("registration");
	}
}