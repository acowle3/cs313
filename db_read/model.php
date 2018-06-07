<?php

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
    $sql = 'SELECT thread_title, thread_id FROM simple_imageboard.thread ORDER BY recent_post_date';  
    $stmt = $db->query($sql);

    $stmt->execute(); 
    $threads = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 
    $stmt->closeCursor(); 

    return $threads;
}

function getMessages($threadId) {
    global $db;
    $sql = 'SELECT message_body, user_email, message_date FROM simple_imageboard.message WHERE thread_id=:threadId ORDER BY message_date';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":threadId", $threadId, PDO::PARAM_INT);
    $stmt->execute();
    
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $messages;
}