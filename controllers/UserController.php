<?php

class UsersController extends Controller {
    // properties

    // constructor 
    public function __construct()
    {   
        
        parent::__construct();
    }

    public function getLogin() {
        include "views/login.php";
    }

    public function login() {
        $url =  ROOT . "login"; //edit to home
       $user = new User($this->conn);
       // check user exists
       if($user->getUserByName($this->req['username'])->checkUserExists()) {
            if($user->validateLogin($this->req)->success()) {
                $user->login();
                Messenger::setMsg("Logged in!", "success");
                //Router::redirect("");
                header('Location: ' . $url);
                var_dump($user);
                var_dump($user->user);
                echo "success";
            } else {
               echo "password fail!";
               var_dump($user->user);
            }
       } else {
            $errors['username_err'] = "User does not exist!";
            include "views/login.php";
       }
    }

    public function create() {
        // create a new User model
        $user = new User($this->conn);
        $url =  ROOT . "login";
        // call User validateNewUser($this->req)->success()
        if($user->validateNewUser($this->req)->success()) {
            if($user->create()->success()) {
                $user->login();
                Messenger::setMsg("New account created!", "success");
                //Router::redirect("");
                header('Location: ' . $url);
            }
        } else {
            $errors = $user->errors;
            include "views/login.php";
        }
    }

    public function logout() {
        $url =  ROOT . "login"; //edit to home
        Messenger::setMsg("Logged out!", "warning");
        $_SESSION = [];
        header('Location: ' . $url);
        
    }
    public function profile(){

    }
}