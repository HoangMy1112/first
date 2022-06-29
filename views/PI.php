<?php

echo "jello";

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
    <h3>Upload some image here:</h3>
    <hr>
    <form action="<?= ROOT ?>img" method="post" enctype="multipart/form-data">
        <input type="text" name="alt" placeholder="Alt text here"> <br>
        <input type="file" name="upload">
        <button type="submit">click to upload</button>
    </form>
    <hr>
</body>
</html>
<?php
//var_dump($_POST);
//var_dump($_FILES);
?>