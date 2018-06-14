<?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 $id = filter_input(INPUT_GET, 'id');
 if($id == NULL) {
     echo "ERROR, NO ID SELECTED";
 }
 else {
    $messages = getMessages($id);
    $theTitle = getThreadTitle($id);
 }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <header>
            <h1>Simple Message Board</h1>
        </header>
        <main>
            <h1 class="thread-title"><?php echo $theTitle['thread_title'] ?></h1>
        <?php
        foreach($messages as $message) {
            echo "<article class='the-messages'>";
            echo "<h1>".$message['user_email']."</h1>";
            echo "<h3>".date('M d, Y; G:i', strtotime($message['message_date'])).'</h3>';
            echo "<p>".$message['message_body']."</p>";
            echo "</article>";
        }
        ?>
            <form action="index.php" method="post" class="new-message">
                <input type="text" id="email" name="email" placeholder='email'><br>
                <textarea rows="5" cols="50" name="aBody" id="aBody"></textarea><br>
                <input type="hidden" id="message_id" name="message_id" value='<?php echo $id; ?>' >
                <input type="hidden" name="action" id="action" value="post_message">
                <button type="submit">Submit new message</button>
            </form>
            <h3><a href="?action=home">Back to Home</a></h3>
        </main>
    </body>
</html>
