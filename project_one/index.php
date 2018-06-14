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
    if ($action == NULL)
    {
        
        if ($action == NULL) {
            $action = 'home';
        }
    }
}

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
        $theBody = nl2br(filter_input(INPUT_POST, 'theBody'));
        if($title == NULL || $title == false
           || $email == NULL || $email == false
           || !filter_var($email, FILTER_VALIDATE_EMAIL) 
           || $theBody == NULL || $theBody == false) {
            $error = "Incorrect input";
            header('Location: .?action=new_thread');
        }
        else {
            $id = insertNewThread($title, $email, $theBody);
            header('Location: .?action=thread&id='.$id);
        }
        break;
    case 'post_message':
        $email = filter_input(INPUT_POST, 'email');
        $theBody = nl2br(filter_input(INPUT_POST, 'aBody'));
        $id = filter_input(INPUT_POST, 'message_id');
        if($email == NULL || $email == false
           || !filter_var($email, FILTER_VALIDATE_EMAIL) 
           || $theBody == NULL || $theBody == false) {
            $error = "Incorrect input";
            header('Location: .?action=thread&id='.$id);
        }
        else {
            insertNewMessage($theBody, $id, $email);
            header('Location: .?action=thread&id='.$id);
            break;
        }
    default:
        include 'home.php';
        break;
}