<?php
function getImages() {
    global $conn;
    $sql = "SELECT profile_img FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->get_result();
    return $results->fetch_all(MYSQLI_ASSOC);
    //return assoc array of images
}