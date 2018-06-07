 <?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 require 'model.php'; 
 $threads = getThreads();
 ?>
<html>
<header>
    <meta charset="UTF-8">
    <title>Threads</title>
</header>
<body>
    <h1>Threads</h1>
    <ul>
        <?php
        foreach ($threads as $thread) {
            echo "<li>" . "<a href='thread.php?id=".urlencode($thread['thread_id'])."'>".$thread['thread_title']."</a></li>";
        }
            ?>
    </ul>
</body>
</html>
