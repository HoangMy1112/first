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
    <?php
    var_dump($image);
    ?>
    <?php if(!empty($image)): ?>
            <img src="<?php echo $image[$img['profile_img']]; ?>" alt="" style="margin-top: 20px;" width="200px">
            <br>
    <?php else: ?>
        <h1>No images found!</h1>
    <?php endif; ?>
</body>
</html>
<?php
var_dump($_POST);
var_dump($_FILES);
var_dump($image);
?>