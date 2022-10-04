<?php
function getPosts($connect) {
    $posts = mysqli_query($connect, "SELECT * FROM `abi_tester`");
    $postLIst = [];
    while ($post = mysqli_fetch_assoc($posts)) {
        $postLIst[] = $post;
    }
    echo json_encode($postLIst);
}
function getPost($connect ,$id) {
    $posts = mysqli_query($connect, "SELECT * FROM `abi_tester` WHERE `id`='$id'");
    if (mysqli_num_rows($posts)===0) {
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "PostNotFound",
        ];
        echo json_encode($res);
    } else {
        $post = mysqli_fetch_assoc($posts);
        echo json_encode($post);
    }
}
function addPost($connect, $data) {
    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect, "INSERT INTO `abi_tester` (`id`, `title`, `body`) VALUES (NULL, '$title', '$body')") or die(mysqli_error($connect));;
     $res = [
         "status" => true,
         "postId" => mysqli_insert_id($connect)
     ];
     http_response_code(201);
     echo json_encode($res);
}
function updatePost($connect, $id, $data){
    $title = $data['title'];
    $body = $data['body'];
    mysqli_query($connect, "UPDATE `abi_tester` SET `title` = $title, `body` = '$body' WHERE `abi_tester`.`id` = $id") or die(mysqli_error($connect));;
    $res = [
        "status" => true,
        "mes" => "updated"
    ];
    echo json_encode($res);
}