<?php
class Home_test extends TestCase{
    public function test_webpageShownWhenUnlogged(){
        $output = $this->request("POST", "home");
        $this->assertContains('main_home_unlogged', $output);
    }
    
    public function test_webpageShownWhenLogged(){
        $user = new User(array("username" => "username", "password" => "password", "email" => "email@example.com"));
        $this->CI->usermanager->signUserIn($user);
        $output = $this->request("POST", "home");
        $this->assertContains('main_home_logged', $output);
    }
}