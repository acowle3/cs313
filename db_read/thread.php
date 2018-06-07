<?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 require 'model.php'; 
 $id = $_GET["id"];
 if($id == NULL) {
     echo "ERROR, NO ID SELECTED";
 }
 else {
    $messages = getMessages($id);
 }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <main>
        <?php
        foreach($messages as $message) {
            echo "<article>";
            echo "<h1>".$message['user_email']."</h1>";
            echo "<p>".$message['message_body']."</p>";
            echo "</article>";
        }
        ?>
        </main>
    </body>
</html>
