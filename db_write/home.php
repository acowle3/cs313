 <?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
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
        foreach ($threads as $thread) : ?>
        <li>
            <a href="?action=thread&amp;id=<?php echo $thread['thread_id']; ?>"> 
                <?php echo $thread['thread_title']; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <h3><a href="?action=new_thread">Create New Thread</a></h3>
</body>
</html>
