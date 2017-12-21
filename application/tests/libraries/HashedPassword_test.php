<?php
require_once(APPPATH."libraries/HashedPassword.php");
class HashedPassword_test extends TestCase{
    public static function setUpBeforeClass(){
        
    }
    
    public function test_correctPasswordHash(){
        $password = new HashedPassword("password");
        $hashedPassword = (new HashedPassword("password"))->hashStoredPassword()->getPassword();
        $this->assertTrue(password_verify($password->getPassword(), $hashedPassword));
    }
    
    public function test_CompareNormalPasswords(){
        $password1 = new HashedPassword("password");
        $password2 = new HashedPassword("password");
        $wrongPassword = new HashedPassword("password2");
        $this->assertTrue($password1->equalTo($password2));
        $this->assertFalse($password1->equalTo($wrongPassword));
        
    }
    
    public function test_compareNormalAndHashedPasswords(){
        $password1 = new HashedPassword("password");
        $password2 = new HashedPassword("password");
        $password2->hashStoredPassword();
        $wrongPassword = new HashedPassword("incorrectPassword");
        
        $this->assertTrue($password1->equalTo($password2));
        $this->assertTrue($password2->equalTo($password1));
        $this->assertFalse($password2->equalTo($wrongPassword));
        $this->assertFalse($wrongPassword->equalTo($password2));
    }
    
    public function test_hashedPasswordsAreEqual(){
        $password1 = new HashedPassword('$2y$10$i3wuWW.jeFM.t6N3EjTRl.xZxP291FCS2hB58o//3pOb.bHcepG8e', true);
        $password2 = new HashedPassword('$2y$10$i3wuWW.jeFM.t6N3EjTRl.xZxP291FCS2hB58o//3pOb.bHcepG8e', true);
        $wrongPassword = new HashedPassword('$2y$10$i3wuWW.jeFM.t6N3EjTRl.xzxP291FCS2hB58o//3pOb.bHcepG8e', true);
        $this->assertTrue($password1->equalTo($password2));
        $this->assertFalse($password1->equalTo($wrongPassword));
    }
    
    public function test_hashedPasswordEqualToString(){
        $password1 = new HashedPassword('password');
        $password1->hashStoredPassword();
        $password2 = "password";
        $this->assertTrue($password1->equalTo($password2));
    }
    
}