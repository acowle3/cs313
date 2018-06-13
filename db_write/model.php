<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try
{
    $user = 'postgres';
    $password = 'password';
    $db = new PDO('pgsql:host=localhost;dbname=postgres', $user, $password);

        // this line makes PDO give us an exception when there are problems,
        // and can be very helpful in debugging! (But you would likely want
        // to disable it for production environments.)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}

function getThreads() {

    global $db;
    $sql = 'SELECT thread_title, thread_id '
            . 'FROM simple_imageboard.thread '
            . 'ORDER BY recent_post_date DESC';  
    $stmt = $db->query($sql);

    $stmt->execute(); 
    $threads = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 
    $stmt->closeCursor(); 

    return $threads;
}

function getMessages($threadId) {
    global $db;
    $sql = 'SELECT message_body, user_email, message_date '
            . 'FROM simple_imageboard.message '
            . 'WHERE thread_id=:threadId ORDER BY message_date';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":threadId", $threadId, PDO::PARAM_INT);
    $stmt->execute();
    
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $messages;
}
function getThreadTitle($threadId)
{
    global $db;
    $sql = 'SELECT thread_title FROM simple_imageboard.thread '
            . 'WHERE thread_id=:threadId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':threadId', $threadId, PDO::PARAM_INT);
    $stmt->execute();
    $title = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $title;
}

function insertNewThread($title, $email, $theBody) {
    global $db;
    $sql = 'INSERT INTO simple_imageboard.thread (thread_title, user_email, recent_post_date) '
            . 'VALUES (:title, :email, now()) RETURNING thread_id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $threadId = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    $sqlII = 'INSERT INTO simple_imageboard.message (message_body, thread_id, user_email) '
            . 'VALUES (:theBody, :threadId, :email)';
    $stmtII = $db->prepare($sqlII);
    $stmtII->bindValue(':theBody', $theBody, PDO::PARAM_STR);
    $stmtII->bindValue(':threadId', $threadId['thread_id'], PDO::PARAM_INT);
    $stmtII->bindValue(':email', $email, PDO::PARAM_STR);
    $stmtII->execute();
    $stmtII->closeCursor();
    
    return $threadId['thread_id'];
}

function insertNewMessage($theBody, $threadId, $email) {
    global $db;
    $sql = 'INSERT INTO simple_imageboard.message (message_body, thread_id, user_email) '
            . 'VALUES (:theBody, :threadId, :email)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':theBody', $theBody, PDO::PARAM_STR);
    $stmt->bindValue(':threadId', $threadId, PDO::PARAM_INT);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    
    $sqlII = 'UPDATE simple_imageboard.thread '
            . 'SET recent_post_date = now() '
            . 'WHERE thread_id = :threadId';
    $stmtII = $db->prepare($sqlII);
    $stmtII->bindValue(':threadId', $threadId, PDO::PARAM_INT);
    $stmtII->execute();
    $stmtII->closeCursor();
}