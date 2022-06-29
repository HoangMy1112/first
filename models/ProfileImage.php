<?php
class ProfileImage{
    public $userid;
    public $path;
    public $filename; 
    public $file_ext;
    public $file_size;
    public $file_temp;
    public $new_name;
    public $dest;
    public $allowed_ext;
    public $errors = [];
    public $img = [];
    //public $imgs = [];

    public function __construct($conn) {
        $this->conn = $conn;
    }
    public function getImage() {
        return $this->img;
    }

    public function fetchImg($id){
       $this->userid = $id;
        $sql = "SELECT profile_img
                FROM users
                WHERE users.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $this->userid);
        $stmt->execute();
        $result = $stmt->get_result();
        var_dump($result);
        if($result->num_rows !== 1) {
            $this->errors['fetch_err'] = "Couldn't retrieve resource!";
        } else {
            $this->img = $result->fetch_assoc();
        }
        return $this;   
    }

    public function validateImg(){
        if(isset($_POST['alt'])) {
            $file = $_FILES['upload'];
            var_dump($file);
            if($file['error'] === 0) {
                $errors = [];
                $this->filename = $file['name'];
                $this->file_ext = explode("/",$file['type']);
                $this->file_ext = end($this->file_ext);
                $this->file_size = $file['size'];
                $this->file_temp = $file['tmp_name'];
                $this->allowed_ext = ['png', 'jpeg', 'jpg', 'gif'];
                var_dump($this->file_temp);
                // check the file size > 5mb
                if($this->file_size > 5000000) {
                    $this->errors['size'] = "File is too large";
                }
                // check the ext = png, jpeg, jpg, gif in_array() 
                if(!in_array(strtolower($this->file_ext), $this->allowed_ext)) {
                    $this->errors['type'] = "File ext not allowed";
                    var_dump($this->file_ext);
                }
                // if there are no errors move the file from tmp to images folder
                if(empty($this->errors)) {
                    // rename the file
                    $this->new_name = uniqid("itec_") . "." . $this->file_ext;
                    // set the destinations ie images/filename.png
                    $this->dest = "public/image/" . $this->new_name; //edit later????
                    var_dump($this->dest);
                    // up move_uploaded_file(temp, dest)
                    move_uploaded_file($this->file_temp, $this->dest);
                    $sql = "UPDATE users SET profile_img = ? WHERE id = 1"; // if you get cannot bind param on boolean check your sql
                    $stmt =  $this->conn->prepare($sql);
                    //$stmt = $this->conn->query("UPDATE users SET profile_img = ? WHERE id = 1"); //edit laterrrrrrr
                    $stmt->bind_param("s", $this->dest);
                    $stmt->execute();
                    var_dump($stmt);
                } else {
                    var_dump($this->errors);
                }
            } else {
                
            }
            return $this;

        }
    }

    public function success() {
        if(empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }
}
