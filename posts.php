<?php
function uploadImage($image) {
    $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
    $filename = uniqid() . "." . $extension;
    move_uploaded_file($image['tmp_name'], "uploads/" . $filename );
    return $filename;
}
function addPost($title, $content, $filename) {
    $pdo = new PDO('mysql:host=localhost;dbname=mvcdambinov', 'root', 'root') or die("asdasda");
    $sql = "INSERT INTO `mvc` (`title`, `content`, `image`) VALUES (:title, :content, :image)";
    $statment = $pdo->prepare($sql);
    $statment->bindParam(":title", $title);
    $statment->bindParam(":content", $content);
    $statment->bindParam(":image", $$filename);
    $statment->execute();
}
function getPost() {
    $pdo = new PDO('mysql:host=localhost;dbname=mvcdambinov', 'root', 'root') or die("asdasda");
    $statment = $pdo->prepare("SELECT * FROM `mvc`");
    $statment->execute();
    $posts = $statment->fetchAll('PDO::FETCH_ASSOC');
    return $posts;
}