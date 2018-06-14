 <?php 
 error_reporting(E_ALL);
ini_set('display_errors', 1);
 $threads = getThreads();
 
 ?>
<html>
<header>
    <meta charset="UTF-8">
    <title>Threads</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</header>
<body>
    <header>
            <h1>Simple Message Board</h1>
        </header>
    <main>
    <h1 class="thread-title">Threads</h1>
    
        <?php
        foreach ($threads as $thread) : ?>
    <article class='the-threads'>
        <h2><a href="?action=thread&amp;id=<?php echo $thread['thread_id']; ?>"> 
                <?php echo $thread['thread_title']; ?>
            </a></h2>
        <h4>Posted <?php echo date('M d, Y; G:i', strtotime($thread['thread_date'])).' by '.$thread['user_email']; ?></h4>
        <h4>Recent post <?php echo date('M d, Y; G:i', strtotime($thread['recent_post_date'])); ?></h4>
        </article>
        <?php endforeach; ?>
    
    <h3><a href="?action=new_thread">Create New Thread</a></h3>
    </main>
</body>
</html>
