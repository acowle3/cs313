<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

try
{
    $dbUrl = getenv('DATABASE_URL');

  $dbopts = parse_url($dbUrl);

  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
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
            . 'FROM thread '
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
            . 'FROM message '
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
    $sql = 'SELECT thread_title FROM thread '
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
    $sql = 'INSERT INTO thread (thread_title, user_email, recent_post_date) '
            . 'VALUES (:title, :email, now()) RETURNING thread_id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $threadId = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    
    $sqlII = 'INSERT INTO message (message_body, thread_id, user_email) '
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
    $sql = 'INSERT INTO message (message_body, thread_id, user_email) '
            . 'VALUES (:theBody, :threadId, :email)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':theBody', $theBody, PDO::PARAM_STR);
    $stmt->bindValue(':threadId', $threadId, PDO::PARAM_INT);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    
    $sqlII = 'UPDATE thread '
            . 'SET recent_post_date = now() '
            . 'WHERE thread_id = :threadId';
    $stmtII = $db->prepare($sqlII);
    $stmtII->bindValue(':threadId', $threadId, PDO::PARAM_INT);
    $stmtII->execute();
    $stmtII->closeCursor();
}