<?php

require "db.php";
class User
{

    private array $error = array();
    private string $email, $password, $passwordR;

    public function __construct()
    {
    }

    public function setUser(array $post)
    {


        foreach ($post as $key => $value) {


            if ($key === 'email') $this->email = $value;
            if ($key === 'password') $this->password = $value;
            if ($key === 'passwordR') $this->passwordR = $value;
        }
        return $this;
    }

    public function getUser($email){


        $db = new Db();

        $query = 'SELECT id, email FROM users WHERE email = ?';
        return $db->get($query,[$email]);
        


    }
    public function signUp()
    {



        if ($this->checkEmpty() || $this->emailValidation() || $this->pwdMatch() || $this->pwdValidation()) {
            $error = $this->error;
            $this->error = [];
            return $error;
        }


        $db = new Db();

        // Check if the email already exist on the database

        $query = 'SELECT email FROM users WHERE email = ?';
        $result =  $db->get($query, [$this->email]);



        
        //signing up the user to the database:
        if (!$result) {

            $query = 'INSERT INTO users (email, password, dateCreation) VALUES(?, ?, NOW())';


            $params = [$this->email, $this->password];
           
            $db->post($query, $params);
            $db->destrucConnection();


            return;
        }
        $this->error['email'] = 'This email already exist.';
        $error =  $this->error;
        $this->error = [];
        $db->destrucConnection();

        return $error;
    }

    public  function login($email, $password)
    {

        if (empty($email) || empty($password)) {

            if (empty($email)) {

                $this->error['email'] =  'Please enter a valid email.';
            }
            if (empty($password)) {

                $this->error['password'] =  'Please enter a valid password.';
            }
            $error = $this->error;
            $this->error = [];
            return $error;
        }
        $db = new Db();
        $query = 'SELECT * FROM users WHERE email = ? AND password = ?';
        $params = [$email, $password];
        $result = $db->get($query, $params);
        $db->destrucConnection();


        if (!$result) {
            $this->error['invalidEmail'] = "Sorry, we can't find an account with this email address or password.";

            $error = $this->error;
            $this->error = [];
            return $error;
        }
    
    }

    private function checkEmpty()
    {


        if (empty($this->email) || empty($this->password) || empty($this->passwordR)) {

            if (empty($this->email)) {
                $this->error['email'] = 'Please enter your email address.';
                return true;
            }
            if (empty($this->password)) {
                echo $this->password;
                $this->error['password'] = 'Please enter your password.';
                return true;
            }
            if (empty($this->passwordR)) {
                echo $this->passwordR;
                $this->error['password'] = 'Please repeat your password.';
                return true;
            }
        }
        return false;
    }

    private function emailValidation()
    {

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {

            $this->error['email'] = 'Please enter a valid email address.';
            return true;
        }
        return false;
    }
    private function pwdMatch()
    {

        if ($this->password !== $this->passwordR) {

            $this->error['password'] = "The passwords do not match.";
            return true;
        }
        return false;
    }

    private function pwdValidation()
    {

        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);



        if (!$uppercase || !$lowercase || !$number || strlen($this->password) < 8) {
            $this->error['password'] = "The password must include at least 8 characters at least 1 number at least 1 uppercase and 1 lowercase";
            return true;
        }
        return false;
    }
}
