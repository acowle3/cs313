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
    </head>
    <body>
        <main>
            <h1>New Thread</h1>
            <form action="index.php" method="post" class="new-thread">
                <input name="title" id="title" type="text" placeholder="Title">
                <input name="email" placeholder="Email">
                <textarea rows="5" cols="50" name="theBody" id="theBody"></textarea>
                <input type="hidden" name="action" id="action" value="submit_thread">
                <button type="submit">Submit</button>
            </form>
            <a href="?action=home">Cancel</a>
        </main>
    </body>
</html>
