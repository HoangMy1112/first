<?php
include "controllers/UserController.php";

Router::get("", function() {
    include "views/home.php";
});

Router::get("rooms", function() {
    echo "These are all the rooms!";

    $roomController = new RoomController();
    $roomController->getRooms();
});

Router::get("rooms/get/{id}", function($id) {
    $roomController = new RoomController;
    $roomController->getRoom($id);
});

Router::get("login", function($id) {
    include "views/login.php";
});
Router::get("register", function($id) {
    include "views/register.php";
});
Router::get("head", function() {
    include "views/head.php";
});
Router::get("users/login", function() {
    $usersController = new UsersController;
    $usersController->getLogin();
});
Router::post("users/login", function() {
    $usersController = new UsersController;
    $usersController->login();
});

Router::post("users/create", function() {
    $usersController = new UsersController;
    $usersController->create();
});
Router::get("users/logout", function() {
    $usersController = new UsersController;
    $usersController->logout();
});
Router::post("users/login", function() {
    $usersController = new UsersController;
    $usersController->login();
});
Router::get("users/logout", function() {
    $usersController = new UsersController;
    $usersController->logout();
});
Router::get("users/details", function() {
    include "views/profile.php";
});


Router::get("img", function() {
    include "views/PI.php";
});
Router::post("img", function() {
    $PIController = new ProfileImageController;
    $PIController->show();
});
Router::get("getimg", function() {
    $PIController = new ProfileImageController;
    $PIController->getImage();
});
Router::get("output", function() {
    $image = new ProfileImage(DB::getConn());
    $image = $image->fetchImg(1);
    include "views/profile.php";
});