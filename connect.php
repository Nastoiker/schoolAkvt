
<?php
function uploadImage($image) {
    $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
    $filename = uniqid() . "." . $extension;
    move_uploaded_file($image['tmp_name'], "uploads/" . $filename );
    return $filename;
}
$fileUpload=uploadImage($_FILES["image"]);

$pdo = new PDO('mysql:host=localhost;dbname=mvcdambinov', 'root', 'root') or die("asdasda");
$sql = "INSERT INTO `mvc` (`title`, `content`, `image`) VALUES (:title, :content, :image)";
$statment = $pdo->prepare($sql);
$statment->bindParam(":title", $_POST["title"]);
$statment->bindParam(":content", $_POST["content"]);
$statment->bindParam(":image", $fileUpload);
$statment->execute();