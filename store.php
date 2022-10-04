<?php
require `post.php`;
$fileUpload=uploadImage($_FILES["image"]);
addPost( $_POST['title'],  $_POST['content'],  $fileUpload);
header('Location: /');