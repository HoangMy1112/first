<?php

class ProfileImageController extends Controller {
    // properties

    // constructor 
    public function __construct()
    {   
        
        parent::__construct();
    }

    function getImage() {
        $image = new ProfileImage($this->conn);
        if($image->fetchImg(1)->success()) {
            $image= $image->getImage();
            include "views/profile.php";
        } else {
            //include "views/profile.php";
        }        
        //var_dump($image);

        echo "Show new img ne";
    

       /*  $stmt = $this->conn->query("SELECT profile_img FROM users WHERE users.id = 1"); //edit laterrr
        $results = $stmt->fetch_all(MYSQLI_ASSOC);
        var_dump($results); */
    }
    function show(){
        $image = new ProfileImage($this->conn);
        if($image->validateImg($this->req)->success()) {
            echo "sucess img";
            include "views/profile.php";
        } else {
            $errors = $img->errors;
            include "views/profile.php";
        }
    }

}
?>