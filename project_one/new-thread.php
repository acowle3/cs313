<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            <h1 class="thread-title">New Thread</h1>
            <form action="index.php" method="post" class="new-thread">
                <input name="title" id="title" type="text" placeholder="Title"><br>
                <input name="email" placeholder="Email"><br>
                <textarea rows="5" cols="50" name="theBody" id="theBody"></textarea><br>
                <input type="hidden" name="action" id="action" value="submit_thread">
                <button type="submit">Submit</button><a href="?action=home">Cancel</a>
            </form>
            
        </main>
    </body>
</html>
