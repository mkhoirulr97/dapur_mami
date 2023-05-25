<?php

// File: Authentication.php

class Authentication
{
    private $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function register($first_name, $last_name, $full_name, $sex, $birth_date, $phone, $address, $email, $password)
    {
        $user = new User($first_name, $last_name, $full_name, $sex, $birth_date, $phone, $address, $email, $password);
        $this->users[$email] = $user;
    }

    public function login($email, $password)
    {
        if (isset($this->users[$email])) {
            $user = $this->users[$email];
            if ($user->getPassword() === $password) {
                return true;
            }
        }

        return false;
    }
}
