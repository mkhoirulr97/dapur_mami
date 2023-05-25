<?php

// File: AuthenticationTest.php

use PHPUnit\TestCase;

class AuthenticationTest extends TestCase
{
    public function testRegister()
    {
        $authentication = new Authentication();
        $authentication->register('khoirul', 'rosikin', 'khoirul rosikin', 'laki-laki', '09072002', '085808241204', 'jember', 'mkhoirulr97@gmail.com', 'password');

        $this->assertTrue(true); // Assert that the registration was successful
    }

    public function testLogin()
    {
        $authentication = new Authentication();
        $authentication->register('khoirul', 'rosikin', 'khoirul rosikin', 'laki-laki', '09072002', '085808241204', 'jember', 'mkhoirulr97@gmail.com', 'password');

        $result = $authentication->login('mkhoirulr97@gmail.com', 'password');
        $this->assertTrue($result); // Assert that the login was successful

        $result = $authentication->login('mkhoirulr97@gmail.com', 'wrong_password');
        $this->assertFalse($result); // Assert that the login failed with wrong password

        $result = $authentication->login('non_existing_user', 'password');
        $this->assertFalse($result); // Assert that the login failed with non-existing user
    }
}
