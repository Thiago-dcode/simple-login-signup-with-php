<?php

require 'includes/user.php';
require 'includes/session.php';
$session = new Session();
$user = new User();
if (isset($_SESSION['user'])) {

    if (isset($_POST['logout'])) {

        $session->closeSession();
        include_once 'vistas/login.php';
    } else {
        $userData = $user->getUser($_SESSION['user']);
        include_once 'vistas/home.php';
    }
} else {
    if (isset($_POST['submit'])) {


        $submit = $_POST['submit'];


        function login($user, $session)
        {


            $emailForm = $_POST['email'];
            $passwordForm = $_POST['password'];

            $error = $user->login($emailForm, $passwordForm);

            if (isset($error)) {

                include_once 'vistas/login.php';
            } else {


                $session->setSession('user', $emailForm);

                $userData = $user->getUser($emailForm);
                include_once 'vistas/home.php';
            }
        }
        function register(User $user)
        {



            $error = $user->setUser($_POST)->signUp();

            if (isset($error)) {
               

                include_once 'vistas/signup.php';
            } else {


                $success = 'You have successfully registered';
                include_once 'vistas/login.php';
            }
        };

        if ($submit === 'login') login($user, $session);
        elseif ($submit === 'register') {

            include_once 'vistas/signup.php';
        } else if ($submit === 'signup') {

            register($user);
        }
    } else {

        include_once 'vistas/login.php';
    }
}
