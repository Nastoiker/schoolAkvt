<?php

header('Content-type: json/application');
require 'connection.php';
require 'function.php';
$q = $_GET['q'];
$params = explode('/', $q);
$type = $params[0];
$method = $_SERVER['REQUEST_METHOD'];
if(isset($params[1])) {
    $id = $params[1];

}
switch($method) {
    case 'GET':
        if ($type==='posts') {
            if (isset($id)) {
                getPost($connect, $id);
            } else {
                getPosts($connect);
            }
        }
        break;
    case 'POST':
        if($type=='posts') {
            addPost($connect, $_POST);
        }
        break;
    case 'PATCH':
        if($type=='posts') {
            $data = file_get_contents('php://input');
            $jsonData = json_decode($data, true);
            die(print_r($data));
            updatePost($connect, $id, $data);
        }
}