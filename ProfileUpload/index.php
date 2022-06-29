<?php
include "db.php";
include "func.php";
$imgs = getImages();

if(isset($_POST['alt'])) {
    $file = $_FILES['upload'];
    var_dump($file);
    if($file['error'] === 0) {
        $errors = [];
        $filename = $file['name'];
        $file_ext = explode("/",$file['type']);
        $file_ext = end($file_ext);
        $file_size = $file['size'];
        $file_temp = $file['tmp_name'];
        $allowed_ext = ['png', 'jpeg', 'jpg', 'gif'];
        // check the file size > 5mb
        if($file_size > 5000000) {
            $errors['size'] = "File is too large";
        }
        // check the ext = png, jpeg, jpg, gif in_array() 
        if(!in_array(strtolower($file_ext), $allowed_ext)) {
            $errors['type'] = "File ext not allowed";
        }
        // if there are no errors move the file from tmp to images folder
        if(empty($errors)) {
            // rename the file
            $new_name = uniqid("itec_") . "." . $file_ext;
            // set the destinations ie images/filename.png
            $dest = "images/" . $new_name;
            // up move_uploaded_file(temp, dest)
            move_uploaded_file($file_temp, $dest);
            $alt_text = htmlspecialchars($_POST['alt']);
            $sql = "INSERT INTO files (alt_text, file_url) VALUES (?, ?)"; // if you get cannot bind param on boolean check your sql
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $alt_text, $dest);
            $stmt->execute();
            var_dump($stmt);
        } else {
            var_dump($errors);
        }
    } else {
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 5%;
        }
        input {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h3>Upload some file here:</h3>
    <hr>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="text" name="alt" placeholder="Alt text here"> <br>
        <input type="file" name="upload">
        <button type="submit">Upload</button>
    </form>
    <hr>
    <!-- output images here -->
    <?php if(!empty($imgs)): ?>
        <?php foreach($imgs as $img): ?>
            <img src="<?php echo $img['file_url']; ?>" alt="" style="margin-top: 20px;" width="200px">
            <h5><?php echo $img['alt_text']; ?></h5>
            <br>
        <?php endforeach; ?>
    <?php else: ?>
        <h1>No images found!</h1>
    <?php endif; ?>
</body>
</html>
<?php
var_dump($_POST);
var_dump($_FILES);
?>