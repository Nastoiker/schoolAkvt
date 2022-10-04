
<?php

$fileUpload=uploadImage($_FILES["image"]);
$sql = "INSERT INTO `mvc` (`title`, `content`, `image`) VALUES (:title, :content, :image)";

$statment = $pdo->prepare($sql);
$statment->bindParam(":title", $_POST["title"]);
$statment->bindParam(":content", $_POST["content"]);
$statment->bindParam(":image", $fileUpload);
$statment->execute();