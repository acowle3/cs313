<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 require 'model.php';
 
$id = filter_input(INPUT_POST, 'message_id');
if ($id == NULL) {
    $id = filter_input(INPUT_GET, 'message_id');
    if ($id == NULL) {
        $id = filter_input(INPUT_GET, 'id');
        if ($id == NULL) {
            
        }
    }
}
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}
echo $action;
echo $id;
switch ($action) {
    case 'home':
        include 'home.php';
        break;
    case 'thread':
        include 'thread.php';
        break;
    case 'new_thread':
        include 'new-thread.php';
        break;
    case 'submit_thread':
        $title = filter_input(INPUT_POST, 'title');
        $email = filter_input(INPUT_POST, 'email');
        $theBody = filter_input(INPUT_POST, 'theBody');
        $id = insertNewThread($title, $email, $theBody);
        header('Location: .?id=$id');
        break;
    case 'post_message':
        $email = filter_input(INPUT_POST, 'email');
        $theBody = filter_input(INPUT_POST, 'aBody');
        $id = filter_input(INPUT_POST, 'message_id');
        insertNewMessage($theBody, $id, $email);
        header('Location: .?id=$id');
        break;
    default:
        include 'home.php';
        break;
}